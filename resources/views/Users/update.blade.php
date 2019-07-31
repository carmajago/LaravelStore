@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Nuevo usuario</h1>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
    <div class="box" style="margin: 0 50px">
        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field('PATCH') }}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="form-group">
                <label for="name">Nombre</label>
                <input class="form-control" name="name" placeholder="Ingrese el nombre" value="{{ $user['name']}}">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" placeholder="Correo" value="{{ $user['email']}}">
            </div>

            <div class="form-group">
                <select id="role_id" name="role_id" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancelar</a>
            <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop