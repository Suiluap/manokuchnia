<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('username', 'password'), $request->remember)) {
            return back()->with('status', 'Neteisingi prisijungimo duomenys.');
        }

        return redirect()->route('index');
    }

    public function registerIndex()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'username' => 'required|unique:users,username|max:255',
            'password' => 'required|between:6,255',
            'password_confirmation' => 'required|same:password'
        ]);

        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => 1
        ]);

        auth()->attempt($request->only('username', 'password'));

        return redirect()->route('index');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('index');
    }
}
