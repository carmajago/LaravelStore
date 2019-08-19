@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Pagar a provedor</h1>
    <div class="box" style="margin: 0 50px">
        <form method="POST" action="{{ route('providerPayment.store') }}">
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
                <label for="name">Valor</label>
                <input class="form-control" type="number" name="value" placeholder="Valor">
            </div>
            <input type="hidden" class="form-control" name="provider_id" value="{{$providerId}}">
            <a class="btn btn-secondary" href="{{ route('providers.index') }}">Cancelar</a>
            <button type="submit" id="save" class="btn btn-primary">Guardar</button>
        </form>
    </div>
</div>
@stop