@extends('layouts.main')

@section('content')
{{-- išjungta naudotojo pusės duomenų validacija + neprirašyti required --}}
<form action="{{ route('login') }}" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" novalidate>
    @csrf
    <div class="form-group">
        <label for="username" class="sr-only">Slapyvardis</label>
        <input id="username" name="username" type="text" class="form-control @if($errors->has('username') || $errors->has('password') || session('status')) border-danger @endif" placeholder="Slapyvardis">
        @error('username')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Slaptažodis</label>
        <input id="password" name="password" type="password" class="form-control @if($errors->has('username') || $errors->has('password') || session('status')) border-danger @endif" placeholder="Slaptažodis">
        @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-check mb-3">
        <input id="remember" name="remember" type="checkbox" class="form-check-input">
        <label for="remember" class="form-check-label">Atsiminti mane</label>
    </div>
    @if (session('status'))
    <div class="text-danger mb-3">
        {{ session('status') }}
    </div>
    @endif
    <button type="submit" class="btn btn-primary w-100">Prisijungti</button>
</form>
@endsection
