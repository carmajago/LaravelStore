@extends('welcome')

@section('content')

<div class="container">
    <h1 class="text-center">Realizar devolución</h1>
    <div class="box" style="margin: 0 50px">



        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">Cantidad a devolver</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Iva</th>
                    <th scope="col">Producto</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $saleDesail)
                <form method="POST" action="{{ route('salesReturn.store') }}">
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
                    <tr>
                        <input type="hidden" name="sales_return_id" value="{{$saleReturnId}}">
                        <input type="hidden" name="product_id" value="{{$saleDesail['product_id']}}">
                        <td> <input class="form-control" name="product_quantity" min="0" value="0" type="number"> </td>
                        <td> {{ $saleDesail['quantity'] }} </td>
                        <td>{{ $saleDesail["price"] }}</td>
                        <td>{{ $saleDesail["discount"] }} %</td>
                        <td>{{ $saleDesail["iva"] }} %</td>
                        <td>{{ $saleDesail["product"]["name"] }}</td>
                        <td>
                            <button type="submit" id="save" class="btn btn-primary">Realizar devolución</button>


                        </td>
                    </tr>
                </form>

                @endforeach
            </tbody>
        </table>

        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Producto</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($saleReturn as $saleDesail)


                <tr>
                    <td> {{ $saleDesail['product_quantity'] }} </td>
                    <td>{{ $saleDesail["name"] }}</td>
                    <td>


                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop