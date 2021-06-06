@extends('layouts.main')

@section('content')
{{-- Išjungta naudotojo pusės duomenų validacija + neprirašyti required --}}
{{-- Kinda sketchy dinaminių laukų errorų išvedimas --}}
{{-- Ingredientų išvedime arba glaudžiasi išvedimo laukų rėmeliai, arba persidengia, abejais atvejais keistokai atrodo --}}
<form action="{{ route('recipes.new') }}" method="post" class="bg-light p-4 shadow-sm rounded mx-auto mb-5" style="max-width: 540px" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="form-group">
        <label for="name" class="sr-only">Pavadinimas</label>
        <input id="name" name="name" type="text" class="form-control @error('name') border-danger @enderror" placeholder="Pavadinimas" value="{{ old('name') }}">
        @error('name')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="image" class="mb-0">Nuotrauka</label>
        <small id="imageHelp" class="text-muted">Paspauskite žemiau esantį mygtuką.</small>
        {{-- Raudona rėmelio spalva klaidos atveju? Class="border border-danger" atrodo prastai. --}}
        {{-- Value="{{ old('picutre') }}" neveikia dėl saugumo priežasčių --}}
        <input id="image" name="image" type="file" class="form-control-file">
        @error('image')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="description" class="sr-only">Aprašymas</label>
        <textarea id="description" name="description" class="form-control @error('description') border-danger @enderror" rows="3" placeholder="Aprašymas">{{ old('description') }}</textarea>
        @error('description')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="portions" class="sr-only">Porcijos</label>
        <input id="portions" name="portions" type="number" min="1" class="form-control @error('portions') border-danger @enderror" placeholder="Porcijos" value="{{ old('portions') }}">
        @error('portions')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category" class="sr-only">Kategorija</label>
        <select id="category" name="category" class="form-control @error('category') border-danger @enderror">
            <option value="" {{--disabled--}} {{ is_null(old('category')) ? "selected" : "" }} hidden>Kategorija</option>
            @foreach ($categories as $category)
                <option value={{$category->id}} {{ $category->id == old('category') ? "selected" : "" }}>{{$category->name}}</option>
            @endforeach
        </select>
        @error('category')
            <div class="text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="form-group">
        <div class="mb-2">
            <span>Ingredientai</span>
            <button id="addIngredient" type="button" class="btn btn-success float-right badge p-2" onclick="add('ingredient')"><i class="fa fa-plus"></i></button>
        </div>
        @if (old('ingredient') == null && old('quantity') == null && old('measurement') == null)
            <div id="inputFormRow" class="mb-1">
                <div class="input-group">
                    <label for="ingredient" class="sr-only">Ingredientas</label>
                    <input id="ingredient" name="ingredient[]" type="text" class="form-control rounded-left" placeholder="Ingredientas">
                    <label for="quantity" class="sr-only">Kiekis</label>
                    <input id="quantity" name="quantity[]" type="text" class="form-control" placeholder="Kiekis">
                    <label for="measurement" class="sr-only">Matavimo vienetas</label>
                    <input id="measurement" name="measurement[]" type="text" class="form-control" placeholder="Matavimo vienetas">

                    <div class="input-group-append">
                        <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                @if($errors->has('ingredient') || $errors->has('quantity') || $errors->has('measurement'))
                    <div class="text-danger">
                        {{ $errors->first('ingredient') }}
                    </div>
                @enderror
            </div>
        @else
            @php($i = 0)
            @foreach(old('ingredient') as $old)
                <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="ingredient" class="sr-only">Ingredientas</label>
                        <input id="ingredient" name="ingredient[]" type="text" class="form-control rounded-left @if ($errors->has('ingredient.'.$i)) border-danger @endif" placeholder="Ingredientas" value={{ old('ingredient.'.$i) }}>
                        <label for="quantity" class="sr-only">Kiekis</label>
                        <input id="quantity" name="quantity[]" type="number" class="form-control @if ($errors->has('quantity.'.$i)) border-danger @endif" placeholder="Kiekis" value={{ old('quantity.'.$i) }}>
                        <label for="measurement" class="sr-only">Matavimo vienetas</label>
                        <input id="measurement" name="measurement[]" type="text" class="form-control @if ($errors->has('measurement.'.$i)) border-danger @endif" placeholder="Matavimo vienetas" value={{ old('measurement.'.$i) }}>

                        <div class="input-group-append">
                            <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    @if ($errors->has('ingredient.'.$i))
                        <div class="text-danger">
                            Ingredientas - {{ $errors->first('ingredient.'.$i) }}
                        </div>
                    @endif
                    @if ($errors->has('quantity.'.$i))
                        <div class="text-danger">
                            Kiekis - {{ $errors->first('quantity.'.$i) }}
                        </div>
                    @endif
                    @if ($errors->has('measurement.'.$i))
                        <div class="text-danger">
                            Matavimo vienetas - {{ $errors->first('measurement.'.$i) }}
                        </div>
                    @endif
                    @if($loop->last)
                        @if($errors->has('ingredient') || $errors->has('quantity') || $errors->has('measurement'))
                            <div class="text-danger">
                                {{ $errors->first('ingredient') }}
                            </div>
                        @enderror
                    @endif
                </div>
                @php($i ++)
            @endforeach
        @endif
        <div id="newIgredients"></div>
    </div>

    <div class="form-group">
        <div class="mb-2">
            <span>Instrukcija</span>
            <button id="addStep" type="button" class="btn btn-success float-right badge p-2" onclick="add('step')"><i class="fa fa-plus"></i></button>
        </div>
        @if (old('step') == null)
            <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="step" class="sr-only">Žingsnis</label>
                    <input id="step" name="step[]" type="text" class="form-control rounded-left" placeholder="Žingsnis">

                    <div class="input-group-append">
                        <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                @error('step')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        @else
            @php($i = 0)
            @foreach (old('step') as $old)
                <div id="inputFormRow" class="mb-1">
                    <div class="input-group">
                        <label for="step" class="sr-only">Žingsnis</label>
                        <input id="step" name="step[]" type="text" class="form-control rounded-left  @if ($errors->has('step.'.$i)) border-danger @endif" placeholder="Žingsnis" value={{ $old }}>

                        <div class="input-group-append">
                            <button id="removeRow" type="button" onclick="remove(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    @if ($errors->has('step.'.$i))
                        <div class="text-danger">
                            {{ $errors->first('step.'.$i) }}
                        </div>
                    @endif
                    @if($loop->last)
                        @error('step')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    @endif
                </div>
                @php($i ++)
            @endforeach
        @endif
        <div id="newSteps"></div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Įkelti</button>
</form>
@endsection
