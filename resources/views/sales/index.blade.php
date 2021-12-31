@extends('layouts.app')

@section('title', 'Ventas')

@php
$activeOnly = Str::contains(url()->full(), 'active=1');
@endphp

@section('content')
<div class="row">
    <div class="input-group col-sm-12 col-md-6 mb-2">
        <input type="text" class="form-control" id="searchInput">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 mb-2">
        <button id="deliveredFilterBtn" class="btn btn-sm btn-light border h-100">
            <span class="d-sm-none d-md-inline">Entregados</span>
            <i class="fas fa-box"></i>
        </button>
        <button class="btn btn-sm btn-light border h-100 {{ $activeOnly ? 'filter--active' : '' }}">
            <a class="btn btn-sm {{ $activeOnly ? 'text-white' : 'text-dark'}}" href=" {{ $activeOnly ? route('sales.index') : route('sales.index',
                ['active' => true]) }}">
                <span class="d-sm-none d-md-inline">Activas</span>
                <i class="fas fa-dollar-sign"></i>
            </a></button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr class="card-header">
                <th colspan="8">
                    <div class="py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>
                    </div>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>
                    Entrega programada
                </th>
                <th>
                    Entregado
                </th>
                <th>Códigos</th>
                <th>Vendedor</th>
                <th>Fecha venta</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8" class="text-center">
                    <div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection


@section('scripts')

<script src="{{ asset('js/utils/time.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>

<script>
    const sales = Object.values(@json($sales));
    const tableBody = document.querySelector('tbody');
    const showSaleBaseUrl = '{{ route('sales.show', ':sale') }}';
    const showClientBaseUrl = '{{ route('clients.show', ':client') }}';
    const postponeBaseUrl = '{{ route('postpone.form', ':sale') }}';

    const renderSales = (salesToRender) => {
        tableBody.innerHTML = '';

        salesToRender
        .sort((s1, s2) => s2.id - s1.id)
        .forEach(sale => {
            const tr = document.createElement('tr');
            const codes = sale.details.map(detail => detail.code && `<span class="badge badge-sm badge-info">${detail.code}</span>`).join(', ');

            tr.innerHTML = `
                <td>${sale.id}</td>
                <td>
                    <a href="${showClientBaseUrl.replace(':client', sale.client.id)}">${sale.client.name} ${sale.client.lastname}</a>
                </td>
                <td>${getFormattedDate(sale.deliver_on)}</td>
                <td>${sale.delivered_at ? getFormattedDate(sale.delivered_at) : 'No'}</td>
                <td>${codes}</td>
                <td>${sale.seller.name}</td>
                <td>${getTimeAgo(new Date(sale.created_at))}</td>
                <td>
                    <a href="${showSaleBaseUrl.replace(':sale', sale.id)}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                    <a href="${postponeBaseUrl.replace(':sale', sale.id)}" class="btn btn-warning btn-sm"><i class="fas fa-clock"></i></a>
                </td>
            `;
            tableBody.appendChild(tr);
        });
    }

    renderSales(sales);
</script>

<script>
    const deliveredFilterBtn = document.querySelector('#deliveredFilterBtn');
    const searchInput = document.querySelector('#searchInput');

    const flattenObj = (obj, parent, res = {}) => {
        for(let key in obj){
            let propName = parent ? parent + '_' + key : key;
            if(typeof obj[key] == 'object'){
                flattenObj(obj[key], propName, res);
            } else {
                res[propName] = obj[key];
            }
        }
        return res;
    }

    const searchOnSales = () => {
        const params = searchInput.value.toLowerCase();
        const toRender = sales.filter(sale => Object.values(flattenObj(sale)).some(s => String(s).toLowerCase().includes(params)));
        
        toRender.length > 0 
            ? renderSales(toRender)
            : tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No hay ventas que coincidan con la búsqueda</td></tr>';
    }

    const toggleOnlyDelivered = () => {
        const isFiltered = deliveredFilterBtn.classList.contains('filter--active');
        const filterFunction = isFiltered ? sale => true : sale => sale.delivered_at !== null;

        deliveredFilterBtn.classList.toggle('filter--active')
        const toRender = sales.filter(filterFunction);

        toRender.length > 0 
            ? renderSales(toRender)
            : tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No hay ventas para mostrar</td></tr>';
    }

    deliveredFilterBtn.addEventListener('click', toggleOnlyDelivered);
    searchInput.addEventListener('input', searchOnSales);

</script>
@endsection