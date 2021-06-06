@extends('layouts.main')

@section('content')
    @if(session('status'))
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-success mb-4" style="max-width: 420px" >
            {{ session('status') }}
        </div>
    @endif
    @error('role')
        <div class="bg-light p-4 shadow-sm rounded mx-auto text-center text-danger mb-4" style="max-width: 420px" >
            {{ $message }}
        </div>
    @enderror
    @if ($users->count())
    <div class="container bg-light px-4 pt-4 shadow-sm rounded mb-5">
        <h1 class="text-center mb-3">Registruoti naudotojai</h1>

        {{-- Scrollbar galėtų atrodyti geriau --}}
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Slapyvardis</th>
                        <th>Vardas</th>
                        <th>Pavardė</th>
                        <th>El. paštas</th>
                        <th class="text-center">Rolė</th>
                        <th class="text-center"><i class="fa fa-trash"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname }}</td>
                            <td>{{ $user->email }}</td>
                            <form action="{{ route('users.user.role', $user )}}" method="post">
                                @csrf
                                <td class="d-flex justify-content-center">
                                    <select id="role" name="role" class="form-control" style="width:auto" onchange="this.form.submit()">
                                        @foreach ($roles as $role)
                                            <option value={{$role->id}} {{ $role->id == $user->role_id ? "selected" : "" }}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </form>
                            <form action="{{ route('users.delete.user', $user )}}" method="post">
                                @csrf
                                @method('DELETE')
                                <td class="text-center"><button type="submit" class="btn btn-danger" onclick="return confirm('Ar tikrai norite ištrinti šį naudotoją?')"><i class="fa fa-trash"></i></button></td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    @else
    <div class="bg-light p-4 shadow-sm rounded mx-auto text-center" style="max-width: 420px" >
        Deja, šiuo metu svetainėje nėra registruotų naudotojų (išskyrus jus).
    </div>
    @endif
@endsection
