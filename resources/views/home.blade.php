@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-6">

                <h1 class="text-center">Productos más vendidos</h1>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Vendidos</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad disponible</th>
                            <th scope="col">Cantidad mínima</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products->all() as $product)

                        <tr>
                            <td>{{ $product['total'] }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity_available'] }}</td>
                            <td>{{ $product['minimum_quantity'] }}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
            <div class="col-6">

                <h1 class="text-center">Productos menos vendidos</h1>

                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Vendidos</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad disponible</th>
                            <th scope="col">Cantidad mínima</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products2->all() as $product)

                        <tr>
                            <td>{{ $product['total'] }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity_available'] }}</td>
                            <td>{{ $product['minimum_quantity'] }}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $products2->links() }}
            </div>
            <div class="col-12">

                <hr>
            </div>
            <div class="col-6">
                <h1 class="text-center">Productos agotados</h1>
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad disponible</th>
                            <th scope="col">Cantidad mínima</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products3->all() as $product)

                        <tr>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['quantity_available'] }}</td>
                            <td>{{ $product['minimum_quantity'] }}</td>


                        </tr>

                        @endforeach
                    </tbody>
                </table>
                {{ $products3->links() }}
            </div>

        </div>
    </div>
</div>


@stop