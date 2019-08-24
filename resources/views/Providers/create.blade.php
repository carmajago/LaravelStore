@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Nuevo provedor</h1>
    <div class="box" style="margin: 0 50px">
        <form method="POST" action="{{ route('providers.store') }}">
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
                <label for="email">Precio</label>
                <input type="email" class="form-control" name="email" placeholder="Correo">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Telefono</label>
                <input class="form-control" type="number" name="phone" placeholder="Telefono">
            </div>

            <a class="btn btn-secondary" href="{{ route('providers.index') }}">Cancelar</a>
            <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop