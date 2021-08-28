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
                    @include('sales._index')
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