@extends('welcome') @section('content')

<div>
    <div class="container">
        <div class="box" style="margin: 0 50px">
            <h1 class="text-center">Nueva venta</h1>
            <div class="row">
                <div class="col-6">
                    <hr />
                    <h2>Información del cliente</h2>
                    <h4><strong>Nombre:</strong>{{ $sale["client"]["name"] }}</h4>
                    <h4><strong>Telefono:</strong>{{ $sale["client"]["phone"] }}</h4>
                    <h4><strong>Dirección:</strong>{{ $sale["client"]["address"] }}</h4>
                    <h4>
                        <strong>Crédito:</strong>@if($sale["client"]["credit"]) Sí @else No
                        @endif
                    </h4>
                </div>
                <div class="col-6">
                    <hr />
                    <h2>Información de la venta</h2>
                    <h4><strong>Fecha de creación:</strong>{{ $sale["created_at"] }}</h4>
                    <h4><strong>Total crédito:</strong>${{ $sale["total_credit"] }}</h4>
                    <h4><strong>Total contado:</strong>${{ $sale["total_counted"] }}</h4>

                </div>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <hr>
            <h2 class="text-center">Agregar productos</h2>
            <form method="POST" class="form-inline" action="{{ route('sales.storeProduct') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sale_id" value="{{$sale['id']}}">

                <div class="form-group mx-sm-3 mb-2">
                    <input min="0" type="number" style="width: 120px" class="form-control" name="quantity" placeholder="Cantidad">
                </div>
                <div class="form-group mx-sm-3 mb-2">
                    <input min="0" type="number" style="width: 120px" class="form-control" name="discount" placeholder="Descuento">
                </div>

                <div class="form-group mx-sm-3 mb-2">
                    <select id="product_id" name="product_id" class="form-control">
                        <option value="" selected disabled hidden>Selecciona un producto</option>
                        @foreach($products as $product)
                        <option value="{{ $product['id'] }}">{{ $product['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" id="save" class="btn btn-primary mb-2">Agregar</button>
            </form>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Iva</th>
                        <th scope="col">Producto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saleDetails as $saleDesail)

                    <tr>
                        <td>{{ $saleDesail["quantity"] }}</td>
                        <td>{{ $saleDesail["price"] }}</td>
                        <td>{{ $saleDesail["discount"] }} %</td>
                        <td>{{ $saleDesail["iva"] }} %</td>
                        <td>{{ $saleDesail["product"]["name"] }}</td>

                    </tr>

                    @endforeach
                </tbody>
            </table>

            <h4><strong>Neto:</strong> ${{$neto}}</h4>
            <h4><strong>Total+IVA: </strong>${{$iva}}</h4>
            <h4><strong>Precio con descuento: </strong>${{$total}}</h4>
            <hr>
            <button class="btn btn-success btn-block">Terminar compra</button>
        </div>
    </div>
</div>

@stop