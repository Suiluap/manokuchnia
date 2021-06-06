@extends('layouts.main')

@section('content')
    <form action="{{ route('user.password') }}" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" novalidate>
        @csrf
        <h1 class="text-center">
            Jūsų profilis
        </h1>
        <hr>

        <div class="form-group">
            <label for="oldPassword" class="sr-only">Senas slaptažodis</label>
            <input id="oldPassword" name="oldPassword" type="password" class="form-control @error('oldPassword') border-danger @enderror" placeholder="Senas slaptažodis">
            @error('oldPassword')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="sr-only">Naujas slaptažodis</label>
            <input id="password" name="password" type="password" class="form-control @if($errors->has('password') || $errors->has('password_confirmation')) border-danger @enderror" placeholder="Naujas slaptažodis">
            @error('password')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="sr-only">Patvirtinkite naują slaptažodį</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Patvirtinkite naują slaptažodį">
            @error('password_confirmation')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Išsaugoti</button>
    </form>
@endsection
