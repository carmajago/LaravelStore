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

                            <a class="btn btn-info" href="{{ route('sales.show', $sale )}}"><i class="fas fa-info-circle"></i></a>
                        </td>

                    </tr>
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