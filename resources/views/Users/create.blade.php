@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Nuevo usuario</h1>
    <div class="box" style="margin: 0 50px">
        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf

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
                <input class="form-control" name="name" placeholder="Ingrese el nombre">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" class="form-control" name="email" placeholder="Correo">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Contraseña</label>
                <input class="form-control" type="password" name="password" placeholder="Contraseña">
            </div>

            <div class="form-group">
                <select id="role_id" name="role_id" class="form-control">
                    <option value="" selected disabled hidden>Selecciona un role</option>
                    @foreach($roles as $role)
                    <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="photo">Imagen</label>
                <input type="file" id="photo" name="photo">
            </div>

            <a class="btn btn-secondary" href="{{ route('users.index') }}">Cancelar</a>
            <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop