@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1 class="text-center">Ventas</h1>
            </div>
            <div class="col-12" style="margin: 10px">

                <a class="btn btn-primary btn-block" href="{{ route('sales.create1')}}">Nueva venta</a>

            </div>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Crédito total</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">total contado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Usuario</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales->all() as $sale)

                    <tr>
                        <td>{{ $sale['total_credit'] }}</td>
                        <td>{{ $sale['created_at'] }}</td>
                        <td>{{ $sale['total_counted'] }}</td>
                        <td>{{ $sale['client']['name'] }}</td>
                        <td>{{ $sale['user']['name'] }}</td>

                        <td>

                            <a class="btn btn-info" href="{{ route('sales.show', $sales )}}"><i class="fas fa-info-circle"></i></a>
                        </td>
                        <td>
                            @if (auth()->user()->hasRoles(['admin']))
                            <a href="#" data-href="{{ route('sales.destroy', $sale)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            @endif
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

                                    <form method="POST" class="form-delete" action="{{ route('sales.destroy', $sale)}}">
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
            {{ $sales->links() }}
        </div>
    </div>
</div>



<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('href'));
    });
</script>

@stop