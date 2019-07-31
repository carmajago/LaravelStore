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

@stop