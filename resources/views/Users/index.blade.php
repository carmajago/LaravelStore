@extends('welcome')


@section('content')

<div>

    <div class="container">

        <div class="row">

            <div class="col-12">

                <h1 class="text-center">Usuarios</h1>
            </div>
            <div class="col-12" style="margin: 10px">

                <a class="btn btn-primary btn-block" href="{{ route('users.create')}}">Crear nueva usuario</a>

            </div>

            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users->all() as $user)

                    <tr>
                        <td><img src="{{ $user['photo'] }}" class="img-fluid" style="width: 50px"></td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['created_at'] }}</td>
                        <td>{{ $user['role']['name'] }}</td>
                        <td>
                            @if (auth()->user()->hasRoles(['admin']))
                            <a class="btn btn-warning" href="{{ route('users.edit', $user)}}"><i
                                    class="fas fa-edit"></i></a>
                            @endif
                            <a class="btn btn-info" href="{{ route('users.show', $user )}}"><i
                                    class="fas fa-info-circle"></i></a>

                            <a href="#" data-href="{{ route('users.destroy', $user)}}" data-toggle="modal"
                                data-target="#confirm-delete" class="btn btn-danger"><i
                                    class="fas fa-trash-alt"></i></a>

                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
            {{ $users->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Eliminar usuario
            </div>
            <div class="modal-body">
                ¿Estas seguro de eliminar el usuario?
            </div>
            <div class="modal-footer">
                <form method="POST" class="form-delete" action="{{ route('users.destroy', $user)}}">
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

<script>
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.form-delete').attr('action', $(e.relatedTarget).data('href'));
    });
</script>

@stop