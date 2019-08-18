@extends('welcome') @section('content')

<div class="container">
    <div class="box" style="margin: 0 50px">
        <div>
            <h1 class="text-center">Nueva venta</h1>
            <hr />
            <h2>Información del cliente</h2>
            <h4><strong>Nombre:</strong>{{ $client["name"] }}</h4>
            <h4><strong>Telefono:</strong>{{ $client["phone"] }}</h4>
            <h4><strong>Dirección:</strong>{{ $client["address"] }}</h4>
            <h4>
                <strong>Crédito:</strong>@if($client["credit"]) Sí @else No
                @endif
            </h4>
        </div>
        <hr />
        <form method="POST" action="{{ route('sales.store') }}">
            @csrf @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <input name="client_id" type="hidden" value="{{ $client['id'] }}" />
            <div class="form-group">
                <label for="name">Total crédito</label>
                <input
                    class="form-control"
                    name="total_credit"
                    placeholder="Total crédito"
                />
            </div>
            <div class="form-group">
                <label for="total_counted">Total contado</label>
                <input
                    type="number"
                    class="form-control"
                    name="total_counted"
                    placeholder="Total contado"
                />
            </div>
            <button type="submit" id="save" class="btn btn-primary">
                Guardar
            </button>
        </form>
    </div>
</div>
@stop
