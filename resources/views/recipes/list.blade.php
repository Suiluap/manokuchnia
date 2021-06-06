@extends('layouts.main')

@section('content')
    @if(session('status'))
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            {{ session('status') }}
        </div>
    @endif

    @if ($recipes->count())
        <div class="container bg-light px-4 pt-4 shadow-sm rounded mb-5">
            <h1 class="text-center">
                @if (isset($category))
                    {{$category}}
                @elseif (isset($isUserList))
                    Jūsų receptai
                @else
                    Sveiki atvykę@if (Auth::check()), {{ Auth::user()->name }}@endif!
                @endif
            </h1>
            <hr>
            @foreach (array_chunk($recipes->all(), 3) as $recipesChunk)
                <div class="row">
                    @foreach ($recipesChunk as $recipe)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top w-100 d-block" alt="Patiekalo nuotrauka" src={{ asset("storage/pictures/$recipe->user_id/$recipe->image") }}>
                                <div class="card-body d-flex flex-column">
                                    <h2>{{ $recipe->name }}</h2>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit($recipe->description, 100) }}</p>
                                    <a href="{{ route('recipe', $recipe) }}" class="btn btn-primary w-100 mt-auto">Daugiau</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {{ $recipes->links() }}
            </div>
        </div>
    @else
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center" style="max-width: 420px" >
            @if (isset($category))
                Deja, šios kategorijos receptų nėra:(
            @elseif (isset($isUserList))
                Deja, neturite receptų:( Įkelkite receptą <a href="{{ route('recipes.new') }}">paspaudę čia</a>.
            @else
                Deja, šiuo metu svetainėje nėra receptų:(
            @endisset
        </div>
    @endif
@endsection

