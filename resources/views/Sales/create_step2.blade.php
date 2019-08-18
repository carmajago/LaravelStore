@extends('welcome') @section('content')

<div>
    <div class="container">
        <div class="box" style="margin: 0 50px">
            {{$sale}}


            <form method="POST" class="form-inline" action="{{ route('sales.storeProduct') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="sale_id" value="{{$sale['id']}}">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
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
        </div>
    </div>
</div>

@stop