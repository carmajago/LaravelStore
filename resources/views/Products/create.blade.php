@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Nuevo usuario</h1>
    <div class="box" style="margin: 0 50px">
        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
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
                <input type="number" class="form-control" name="price" placeholder="Precio">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Iva</label>
                <input class="form-control" type="number" max="100" name="iva" placeholder="iva">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Cantidad mínima</label>
                <input class="form-control" type="number" name="minimum_quantity" placeholder="Cantidad mínima">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Cantidad máxima</label>
                <input class="form-control" type="number" name="maximum_quantity" placeholder="Cantidad máxima">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Cantidad Disponible</label>
                <input class="form-control" type="number" name="quantity_available" placeholder="Cantidad máxima">
            </div>

            <div class="form-group">
                <select id="role_id" name="product_category_id" class="form-control">
                    <option value="" selected disabled hidden>Selecciona una categoria</option>
                    @foreach($product_categories as $pc)
                    <option value="{{ $pc['id'] }}">{{ $pc['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select id="role_id" name="product_presentation_id" class="form-control">
                    <option value="" selected disabled hidden>Selecciona una presentación</option>
                    @foreach($product_presentations as $pp)
                    <option value="{{ $pp['id'] }}">{{ $pp['description'] }}</option>
                    @endforeach
                </select>
            </div>

            <a class="btn btn-secondary" href="{{ route('products.index') }}">Cancelar</a>
            <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop