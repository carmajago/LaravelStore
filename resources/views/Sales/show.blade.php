@extends('welcome') @section('content')

<div>
    <div class="container">
        <div class="box" style="margin: 0 50px">
            <h1 class="text-center">Información de venta</h1>
            <a class="btn btn-primary" href="{{route('salesReturn.create',$sale)}}">Realizar devolución</a>

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
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Iva</th>
                        <th scope="col">Producto</th>
                        <th scope="col"></th>
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
            <a class="btn btn-secondary" href="{{ route('sales.index')}}">Regresar</a>
        </div>
    </div>
</div>

@stop