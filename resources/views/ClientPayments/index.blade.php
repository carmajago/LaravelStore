@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1 class="text-center">Provedores</h1>
            </div>
            <div class="col-12" style="margin: 10px">

                <a class="btn btn-primary btn-block" href="{{ route('providers.create')}}">Crear nuevo provedor</a>

            </div>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Correo</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($providers->all() as $provider)

                    <tr>
                        <td>{{ $provider['name'] }}</td>
                        <td>{{ $provider['created_at'] }}</td>
                        <td>{{ $provider['phone'] }}</td>
                        <td>{{ $provider['email'] }}</td>
                        <td>
                            @if (auth()->user()->hasRoles(['admin']))

                            <a href="{{ route('providers.destroy', $provider)}}" class="btn btn-primary">Realizar pago</a>
                            <a href="#" data-href="{{ route('providers.destroy', $provider)}}" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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

                                    <form method="POST" class="form-delete" action="{{ route('providers.destroy', $provider)}}">
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
            {{ $providers->links() }}
        </div>
    </div>
</div>



<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('href'));
    });
</script>

@stop