@extends('welcome') @section('content')
<div class="container">
    <div class="row">
        <div class="col-12">

            <h1 class="text-center">Información del provedor</h1>
            <h4><strong>Nombre</strong> {{$provider['name']}}</h4>
            <h4><strong>Fecha de creación</strong> {{$provider['created_at']}}</h4>
            <h4><strong>Email</strong> {{$provider['email']}}</h4>
            <h4><strong>Telefono</strong> {{$provider['phone']}}</h4>
        </div>
    </div>
</div>
<hr>
<h1 class="text-center">Pagos</h1>

<div class="row">
    <a href="{{ route('providerPayment.create',$provider)}}" class="btn btn-primary">Realizar pago</a>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th scope="col">Fecha de creación</th>
                <th scope="col">Valor</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($providerPayments->all() as $pp)

            <tr>
                <td>{{ $pp['created_at'] }}</td>
                <td>${{ $pp['value'] }}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
    {{ $providerPayments->links() }}
</div>
@stop