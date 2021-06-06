<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.view');
    }

    public function editIndex()
    {
        return view('user.edit');
    }

    public function changePasswordIndex()
    {
        return view('user.password');
    }

    public function listIndex()
    {
        $users = User::latest()->where('id', '!=', Auth::id())->paginate(20);
        $roles = Role::all();
        return view('user.list', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function delete()
    {
        $user = User::find(Auth::user()->id);
        $directory = storage_path("app\public\pictures\\".$user->id);
        File::deleteDirectory($directory);
        Auth::logout();
        $user->delete();
        return redirect()->route('index')->with('status', 'Jūsų profilis ištrintas sėkmingai!');
    }

    public function deleteUser(User $user)
    {
        $directory = storage_path("app\public\pictures\\".$user->id);
        File::deleteDirectory($directory);
        $user->delete();
        return redirect()->route('users')->with('status', 'Naudotojas ištrintas sėkmingai!');
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.',id|max:255',
            'username' => 'required|unique:users,username,'.Auth::user()->id.',id|max:255'
        ]);

        $user = User::find(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username
        ]);

        return redirect()->route('user')->with('status', 'Profilis atnaujintas sėkmgingai!');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|between:6,255',
            'password_confirmation' => 'required|same:password'
        ]);

        $currentPassword = Auth::User()->password;
        if(Hash::check($request['oldPassword'], $currentPassword))
        {
            $user = User::find(Auth::user()->id);
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('user')->with('status', 'Slaptažodis pakeistas sėkmingai!');
        }
        else
        {
            return back()->withErrors(['oldPassword' => 'Neteisingas senas slaptažodis.']);
        }
    }

    public function changeRole(User $user, Request $request)
    {
        $this->validate($request, [
            'role' => 'required|exists:roles,id'
        ]);

        $user->update([
            'role_id' => $request->role
        ]);

        return back()->with('status', 'Naudotojo rolė pakeista sėkmingai!');
    }
}
