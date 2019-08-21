@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1 class="text-center">Produtos de baja</h1>
            </div>

            <hr>


            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Posisible razon</th>
                        <th scope="col">Tipo</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($products->all() as $product)

                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['created_at'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['price'] }}</td>
                        <td>{{ $product['possible_low_rate'] }}</td>
                        <td>{{ $product['type'] }}</td>


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