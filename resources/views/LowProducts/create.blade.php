@extends('welcome')

@section('content')
<form method="POST" action="{{ route('lowProducts.store') }}">
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

    <h1>Dar de baja a producto</h1>

    <h4><strong>Nombre:</strong>{{$product["name"]}}</h4>
    <h4><strong>Cantidad disponible:</strong>{{$product["quantity_available"]}}</h4>
    <input type="hidden" name="product_id" value="{{$product['id']}}">
    <div class="form-group">
        <label for="">Cantidad a dar de baja</label>
        <input class="form-control" name="quantity" min="0" value="0" type="number">
    </div>
    <div class="form-group">
        <label for="">Precio</label>
        <input class="form-control" name="price" min="0" value="0" type="number">
    </div>
    <div class="form-group">
        <label for="">Posible razon de baja</label>
        <input class="form-control" name="possible_low_rate" type="text">
    </div>
    <div class="form-group">
        <label for="">Tipo</label>
        <input class="form-control" name="type" type="number">
    </div>

    <button type="submit" id="save" class="btn btn-primary">Realizar devolución</button>


</form>
@stop