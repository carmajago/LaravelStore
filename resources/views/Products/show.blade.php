@extends('welcome') @section('content')
<div class="container">
    <h1 class="text-center">Información de productos</h1>
    <div class="row">
        <div class="col-6">
            <h4><strong>Nombre:</strong>{{ $product["name"] }}</h4>
            <h4>
                <strong>Cantidad mínima:</strong
                >{{ $product["minimum_quantity"] }}
            </h4>
            <h4>
                <strong>Cantidad máxima</strong
                >{{ $product["maximum_quantity"] }}
            </h4>
            <h4>
                <strong>Cantidad disponible</strong
                >{{ $product["quantity_available"] }}
            </h4>
            <h4><strong>categoria:</strong>{{ $product["category"] }}</h4>
            <h4>
                <strong>Presentación:</strong>{{ $product["presentation"] }}
            </h4>
            <a
                href="{{ route('lowProducts.create', $product) }}"
                class="btn btn-primary"
                >Sacar de stock</a
            >
        </div>
        <div class="col-6"></div>
    </div>
</div>

@stop
