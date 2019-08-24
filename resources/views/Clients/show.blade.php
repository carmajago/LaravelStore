@extends('welcome') @section('content')

<div class="container">
    <div class="row">

        <div class="col-12">
            <h1 class="text-center">Información del cliente</h1>
            <h4><strong>Nombre:</strong>{{ $client["name"] }}</h4>
            <h4>
                <strong>Fecha de creación:</strong>{{ $client["created_at"] }}
            </h4>
            <h4><strong>Telefono:</strong>{{ $client["phone"] }}</h4>
            <h4><strong>Dirección:</strong>{{ $client["address"] }}</h4>
            <h4>
                <strong>Crédito:</strong> @if($client['credit']) Sí @else No
                @endif
            </h4>

            <h4>
                <strong>Deuda:</strong> {{$credit}}
            </h4>

            <h4>
                <strong>Calificación:</strong> {{$rating}}
            </h4>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-6">
            <h2 class="text-center">Compras</h2>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Crédito</th>
                        <th scope="col">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales ->all() as $sale)

                    <tr>
                        <td>{{ $sale["created_at"] }}</td>
                        <td>{{ $sale["total_credit"] }}</td>
                        <td>{{ $sale["total_counted"] }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('sales.show', $sale) }}"><i class="fas fa-info-circle"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{$sales -> links()}}
        </div>
        <div class="col-6">
            <h2 class="text-center">Pagos</h2>
            <a class="btn btn-primary" href="{{route('clientPayment.create',$client)}}">Crear pago</a>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Total Crédito</th>
                        <th scope="col">Total contado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments ->all() as $payment)

                    <tr>
                        <td>{{ $payment["created_at"] }}</td>
                        <td>{{ $payment["name"] }}</td>
                        <td>{{ $payment["value"] }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('sales.show', $sale) }}"><i class="fas fa-info-circle"></i></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{$payments -> links()}}
        </div>
    </div>
</div>
@stop