@extends('layouts.main')

@section('content')
{{-- išjungta naudotojo pusės duomenų validacija  + neprirašyti required --}}
<form action="{{ route('register') }}" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" novalidate>
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name" class="sr-only">Vardas</label>
            <input id="name" name="name" type="text" class="form-control @error('name') border-danger @enderror" placeholder="Vardas" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="surname" class="sr-only">Pavardė</label>
            <input id="surname" name="surname" type="text" class="form-control @error('surname') border-danger @enderror" placeholder="Pavardė" value="{{ old('surname') }}">
            @error('surname')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="sr-only">El. paštas</label>
        <input id="email" name="email" type="email" class="form-control @error('email') border-danger @enderror" placeholder="El. paštas" value="{{ old('email') }}">
        @error('email')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="username" class="sr-only">Slapyvardis</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text" id="prepend">@</span>
            </div>
            <input id="username" name="username" type="text" class="form-control @error('username') border-danger @enderror" placeholder="Slapyvardis" aria-describedby="prepend" value="{{ old('username') }}">
        </div>
        @error('username')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password" class="sr-only">Slaptažodis</label>
        <input id="password" name="password" type="password" class="form-control @if($errors->has('password') || $errors->has('password_confirmation')) border-danger @enderror" placeholder="Slaptažodis">
        @error('password')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation" class="sr-only">Patvirtinkite slaptažodį</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Patvirtinkite slaptažodį">
        @error('password_confirmation')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary w-100">Registruotis</button>
</form>
@endsection
