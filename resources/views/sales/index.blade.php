@extends('layouts.app')

@section('title', 'Ventas')
@section('styles')
<style>
    td {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr class="card-header">
                <th colspan="7">
                    <div class="py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>
                    </div>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Entrega programada</th>
                <th>Entregado</th>
                <th>Vendedor</th>
                <th>Fecha venta</th>
                @can('perform-action-on-sale')
                <th>Acciones</th>
                @endcan
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

@endsection