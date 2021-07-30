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
                        <th>Venta</th>
                        <th>Detalle</th>
                        <th>Cliente</th>
                        <th>Entrega programada</th>
                        <th>Fecha venta</th>
                        <th>Producto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->sale_id }}</td>
                        <td><a
                                href="{{ route('clients.show', ['client' => $detail->sale->client->id]) }}">{{ $detail->sale->client->full_name }}</a>
                        </td>
                        <td>{{ $detail->sale->deliver_on->format('d/m/Y') }}</td>
                        <td>{{ $detail->sale->created_at->diffForHumans() }}</td>
                        <td>
                            <p class="my-0"><strong>{{ $detail->product->name }}</strong>
                                [color {{ strtolower($detail->color) }}]
                            </p>
                        </td>
                        <td>
                            <a href="{{ route('without-photo.edit', ['detail' => $detail->id]) }}"
                                class="btn btn-sm btn-info"><i class="fas fa-plus"></i>
                                Agregar foto
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @if($details->hasPages())
                <tfoot>
                    <tr>
                        <th colspan="8">
                            <div class="d-flex justify-content-around align-items-center">
                                {{ $details->links('pagination::bootstrap-4') }}
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