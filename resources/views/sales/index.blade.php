@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="row">
    <div class="input-group mb-2 col-sm-12 col-md-6">
        <input type="text" class="form-control" id="searchInput">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
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
                    <button id="orderByDeliverOnBtn" class="btn btn-sm btn-light border">
                        <i class="fas fa-sort"></i>
                    </button>
                </th>
                <th>
                    Entregado
                    <button id="deliveredFilterBtn" class="btn btn-sm btn-light border">
                        <i class="fas fa-filter"></i>
                    </button>
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
    const sales = @json($sales);
    const tableBody = document.querySelector('tbody');
    const showSaleBaseUrl = '{{ route('sales.show', ':sale') }}';
    const showClientBaseUrl = '{{ route('clients.show', ':client') }}';
    const postponeBaseUrl = '{{ route('postpone.form', ':sale') }}';

    const renderSales = (salesToRender) => {
        tableBody.innerHTML = '';

        salesToRender.forEach(sale => {
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
    const orderByDeliverOnBtn = document.querySelector('#orderByDeliverOnBtn');
    const searchInput = document.querySelector('#searchInput');

    const filters = {
        onlyDelivered: false,
        search: false,
        orderByDeliverOn: 0
    };

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
        return sales.filter(sale => Object.values(flattenObj(sale)).some(s => String(s).toLowerCase().includes(params)));
    }

    const toggleOnlyDelivered = () => {
        deliveredFilterBtn.classList.toggle('filter--active')
        
        return filters.onlyDelivered ? sales.filter(sale => sale.delivered_at !== null) : sales;
    }

    const orderByDeliverOn = () => {
        let orderedSales = sales;

        switch(filters.orderByDeliverOn){
            case -1:
                orderByDeliverOnBtn.classList.contains('filter--active') ? null : orderByDeliverOnBtn.classList.add('filter--active');
                orderedSales = sales.sort((a, b) => Date.parse(a.deliver_on) - Date.parse(b.deliver_on));
                break;
            case 0:
                orderByDeliverOnBtn.classList.contains('filter--active') ? orderByDeliverOnBtn.classList.remove('filter--active') : null;
                break;
            case 1:
                orderByDeliverOnBtn.classList.contains('filter--active') ? null : orderByDeliverOnBtn.classList.add('filter--active');
                orderedSales = sales.sort((a, b) => Date.parse(b.deliver_on) - Date.parse(a.deliver_on));
                break;
            }

        return orderedSales;
    }

    const applyFilters = (filterName) => {       
        tableBody.innerHTML = '<tr><td colspan="8" class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></td></tr>';
        
        let toRender = sales;
            
        if(filterName === 'onlyDelivered') {
            filters[filterName] = !filters[filterName];
            toRender = toggleOnlyDelivered();
        }
        
        if(filterName === 'search') {
            filters[filterName] = searchInput.value === "" ? false : true;
            toRender = searchOnSales();
        }

        if(filterName === 'orderByDeliverOn') {
            switch(filters[filterName]) {
                case -1:
                    filters[filterName] = 0;
                    break;
                case 0:
                    filters[filterName] = 1;
                    break;
                case 1:
                    filters[filterName] = -1;
                    break;
            }
            toRender = orderByDeliverOn();
        }

        toRender.length > 0 
        ? renderSales(toRender)
        : tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No hay ventas</td></tr>';
    }

    deliveredFilterBtn.addEventListener('click', () => applyFilters('onlyDelivered'));
    orderByDeliverOnBtn.addEventListener('click', () => applyFilters('orderByDeliverOn'));
    searchInput.addEventListener('input', () => applyFilters('search'));

</script>
@endsection