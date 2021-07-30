@extends('layouts.app')

@section('title', 'Ventas')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Entrega programada</th>
                        <th>Entregado</th>
                        <th>Vendedor</th>
                        <th>Fecha venta</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->id }}</td>
                        <td><a
                                href="{{ route('clients.show', ['client' => $sale->client->id]) }}">{{ $sale->client->full_name }}</a>
                        </td>
                        <td>{{ $sale->formatted_deliver_on }}</td>
                        <td>{{ $sale->formatted_delivered_at }}</td>
                        <td><a
                                href="{{ route('employees.show', ['employee' => $sale->seller_id]) }}">{{ $sale->seller->full_name }}</a>
                        </td>
                        <td>{{ $sale->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="btn btn-sm btn-info"><i
                                    class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @if($sales->hasPages())
                <tfoot>
                    <tr>
                        <th colspan="8">
                            <div class="d-flex justify-content-around align-items-center">
                                {{ $sales->links('pagination::bootstrap-4') }}
                            </div>
                        </th>
                    </tr>
                </tfoot>
                @endif
            </table>

        </div>
    </div>
</div>

@endsection