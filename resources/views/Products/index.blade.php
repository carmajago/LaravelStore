@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1 class="text-center">Produtos</h1>
            </div>
            <div class="col-12" style="margin: 10px">

                <a class="btn btn-primary btn-block" href="{{ route('products.create')}}">Crear nuevo producto</a>

            </div>
            <hr>

            <form class="form-inline" method="GET" action="{{ route('products.index') }}">
                <div class="form-group mx-sm-3 mb-2">
                    <select id="filter" name="filter" class="form-control">
                        <option value="all">Todos</option>
                        <option value="exhausted">Agotados</option>
                        <option value="defeated">Proximos a vencer</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Filtrar"></button>
                <form>
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col">Precio</th>
                                <th scope="col">iva</th>
                                <th scope="col">Cantidad disponible</th>
                                <th scope="col">Cantidad mínima</th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products->all() as $product)

                            <tr>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['created_at'] }}</td>
                                <td>{{ $product['price'] }}</td>
                                <td>{{ $product['iva'] }}</td>
                                <td>{{ $product['quantity_available'] }}</td>
                                <td>{{ $product['minimum_quantity'] }}</td>
                                <td>
                                    @if (auth()->user()->hasRoles(['admin']))
                                    <a class="btn btn-warning" href="{{ route('products.edit', $product)}}"><i class="fas fa-edit"></i></a>
                                    @endif
                                    <a class="btn btn-info" href="{{ route('products.show', $product )}}"><i class="fas fa-info-circle"></i></a>

                                    <a href="#" data-href="{{ route('products.destroy', $product)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>

                                </td>

                            </tr>
                            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Eliminar usuario
                                        </div>
                                        <div class="modal-body">
                                            ¿Estas seguro de eliminar el usuario?
                                        </div>
                                        <div class="modal-footer">

                                            <form method="POST" class="form-delete" action="{{ route('products.destroy', $product)}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                                                    <input type="submit" class="btn btn-danger" value="Eliminar">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
        </div>
    </div>
</div>



<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('href'));
    });
</script>

@stop