@extends('layouts.main')

@section('content')
    @if(session('status'))
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            {{ session('status') }}
        </div>
    @endif
    <div class="container bg-light p-4 shadow-sm rounded mb-5" style="max-width: 540px">
        <h1 class="text-center">
            Jūsų profilis
        </h1>
        <hr>
        <div><b>Slapyvardis:</b> {{Auth::user()->username}}</div>
        <div><b>Vardas:</b> {{Auth::user()->name}}</div>
        <div><b>Pavardė:</b> {{Auth::user()->surname}}</div>
        <div><b>El. paštas:</b> {{Auth::user()->email}}</div>
        <hr>
        <a class="btn btn-primary"  href="{{ route('user.edit') }}">Redaguoti</a>
        <a class="btn btn-primary" href="{{ route('user.password') }}">Keisti slaptažodį</a>
        <form class="pull-right" action="{{ route('user') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti savo profilį?')"><i class="fa fa-trash"></i></button>
        </form>
    </div>
@endsection
