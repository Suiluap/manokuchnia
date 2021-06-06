@extends('layouts.main')

@section('content')
    @if(session('status'))
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            {{ session('status') }}
        </div>
    @endif
    <div class="container bg-light pt-4 px-4 shadow-sm rounded mb-5">
        <div class="row">
            <div class="col-md-6">
                <img class="w-100 d-block mb-3-md rounded" alt="Patiekalo nuotrauka" src={{ asset("storage/pictures/$recipe->user_id/$recipe->image") }}>
            </div>
            <div class="col-md-6">
                <h1 class="d-inline">{{ $recipe->name }}</h1>

                @if (Auth::check() && ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin()))
                    <form class="pull-right" action="{{ route('recipe', $recipe )}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti šį receptą?')"><i class="fa fa-trash"></i></button>
                    </form>
                @endif

                <div>
                    @<i>{{$recipe->user->username}}</i>
                </div>

                <p class="mb-1">{{ $recipe->description }}</p>

                <div>
                    <label for="portions">Porcijos:</label>
                    <input id="portions" name="portions" type="number" min="1" max="99" style="width: 45px;" value="{{ $recipe->portions }}" onmouseup="calculateIngredients()" onkeyup="calculateIngredients()">
                    <input type="hidden" id="oldPortions" value="{{ $recipe->portions }}"/>
                </div>

                <hr>
                <h2>Ingredientai</h2>
                <ul>
                @foreach ($recipe->ingredients as $ingredient)
                    <li class="ingredient">{{ $ingredient->name }}, <span class="quantity">{{ $ingredient->quantity }}</span> {{ $ingredient->measurement }}</li>
                @endforeach
                </ul>

                <hr>
                <h2>Instrukcija</h2>
                <ol class="mb-0">
                @foreach ($recipe->steps as $step)
                    <li>{{ $step->instructions }}</li>
                @endforeach
                </ol>

                @if (Auth::check() && ($recipe->ownedBy(Auth::user()) || Auth::user()->isAdmin()))
                    <a class="btn btn-primary btn-block mt-3" href="{{ route('recipe.edit', $recipe) }}">Redaguoti</a>
                @endif
            </div>
        </div>
        <hr>
        <div>
            <h2>Komentarai</h2>
            @auth
                <form action="{{ route('recipe', $recipe) }}" class="mb-2" method="post" novalidate>
                    @csrf
                    <div class="d-flex">
                        <label for="comment" class="sr-only">Komentaras</label>
                        <textarea id="comment" name="comment" class="form-control mr-1 @error('comment') border-danger @enderror" rows="1" placeholder="Komentaras">{{ old('comment') }}</textarea>
                        <button type="submit" class="btn btn-primary">Įrašyti</button>
                    </div>
                    @error('comment')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </form>
            @endauth



            @if($comments->count())
                @foreach ($comments as $comment)
                    <div class="bg-white border rounded p-2 mt-2">
                        <div>
                            @<i>{{ $comment->user->username }}</i> -
                            <small class="text-muted">
                                {{ $comment->created_at->diffForHumans() }}
                            </small>
                            @if (Auth::check() && ($comment->ownedBy(Auth::user()) || Auth::user()->isAdmin()))
                                <form class="pull-right" action="{{ route('comment', $comment )}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger badge badge-pill"><i class="fa fa-minus"></i></button>
                                </form>
                            @endif
                        </div>
                        <p class="mb-0">{{ $comment->text }}</p>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center mt-3">
                    {{ $comments->links() }}
                </div>
            @else
                <p class="mb-0 pb-3">
                    @auth
                        Būkite pirmieji pakomentavę šį receptą:)
                    @else
                        Deja, šis receptas kol kas neturi komentarų:(
                    @endauth
                </p>
            @endif
        </div>
    </div>
@endsection
