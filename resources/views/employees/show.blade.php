@extends('layouts.app')

@section('title', 'Ver empleado')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Ventas de {{ $employee->full_name }}</h6>
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
                    @foreach ($employee->sales as $sale)
                    @include('sales._index')
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection