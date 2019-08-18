@extends('welcome') @section('content')

<div>
    <div class="container">
        <div class="row">
            <h2>Buscar usuario</h2>
            <form method="GET" class="form-inline" action="{{ route('sales.create1') }}">
                <div class="form-group mx-sm-3 mb-2">
                    <input class="form-control" name="name" id="name" placeholder="ingrese el nombre" />
                </div>
                <input type="submit" class="btn btn-primary" value="Buscar" />
            </form>
            <div class="col-12">
                <h1 class="text-center">Clientes</h1>
            </div>
            @if($clients->total() != 0)
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Crédito total</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients->all() as $client)

                    <tr>
                        <td>{{ $client["name"] }}</td>
                        <td>{{ $client["created_at"] }}</td>
                        <td>{{ $client["phone"] }}</td>
                        <td>{{ $client["address"] }}</td>
                        <td><a href="{{ route('sales.create',$client)}}">Seleccionar</a></td>

                    </tr>

                    @endforeach
                </tbody>
            </table>

            {{ $clients->links() }}
            @else
            <h1>No se encontraron clientes</h1>

            <div class="container">
                <h1 class="text-center">Nuevo usuario</h1>
                <div class="box" style="margin: 0 50px">
                    <form method="POST" action="{{ route('sales.create2') }}">
                        @csrf @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input class="form-control" name="name" placeholder="Ingrese el nombre" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="number" class="form-control" name="phone" placeholder="Telefono" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Dirección</label>
                            <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Dirección" />
                        </div>
                        <div class="form-group">
                            <label for="credit">Crédito</label>
                            <input type="checkbox" name="credit" placeholder="Credito" value="1" {{ old('credit') ? 'checked="checked"' : '' }
                            />
                        </div>

                        <button type="submit" id="save" class="btn btn-primary">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@stop