@extends('layouts.app')

@section('title', 'Ventas')
@section('styles')
<style>
    td {
        white-space: nowrap;
    }

    .filter--active {
        background-color: var(--primary);
        color: #FFF;
    }

    .filter--active:hover {
        color: #fff;
        background-color: #2e59d9;
        border-color: #2653d4;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="input-group mb-2 col-sm-12 col-md-6">
        <input type="text" class="form-control" id="searchInput">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <button id="deliveredFilterBtn" class="btn btn-light border"><i class="fas fa-box"></i></button>
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
                <th>Entrega programada</th>
                <th>Entregado</th>
                <th>Códigos</th>
                <th>Vendedor</th>
                <th>Fecha venta</th>
                @can('perform-action-on-sale')
                <th>Acciones</th>
                @endcan
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

<script>
    const DATE_UNITS = {
        day: 86400,
        hour: 3600,
        minute: 60,
        second: 1
    };

    const getSecondsDiff = timestamp => (Date.now() - timestamp) / 1000;

    const getUnitAndValue = secondsElapsed => {
        for(const [unit, secondsInUnit] of Object.entries(DATE_UNITS)) {
            if(secondsElapsed >= secondsInUnit || unit === 'second') {
                const value = Math.floor(secondsElapsed / secondsInUnit) * -1;

                return {value, unit};
            }
        }
    }

    const getTimeAgo = (timestamp) =>{
        const rtf = new Intl.RelativeTimeFormat('es');
        const secondsElapsed = getSecondsDiff(timestamp);
        const {value, unit} = getUnitAndValue(secondsElapsed);

        return rtf.format(value, unit);
    }
</script>

<script>
    const getFormatedDate = (timestamp, style = {dateStyle: 'medium'}) => {
        const dtf = new Intl.DateTimeFormat('es', style);
        return dtf.format(new Date(timestamp));
    }
</script>

<script>
    const sales = @json($sales);
    const tableBody = document.querySelector('tbody');
    const showSaleBaseUrl = '{{ route('sales.show', ':sale') }}';
    const showClientBaseUrl = '{{ route('clients.show', ':client') }}';

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
                <td>${getFormatedDate(sale.deliver_on)}</td>
                <td>${sale.delivered_at ? getFormatedDate(sale.delivered_at) : 'No'}</td>
                <td>${codes}</td>
                <td>${sale.seller.name}</td>
                <td>${getTimeAgo(new Date(sale.created_at))}</td>
                <td>
                    <a href="${showSaleBaseUrl.replace(':sale', sale.id)}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
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

    const filters = {
        onlyDelivered: false,
        search: false
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
        filters.onlyDelivered
            ? deliveredFilterBtn.innerHTML = '<i class="fas fa-box-open"></i>'
            : deliveredFilterBtn.innerHTML = '<i class="fas fa-box"></i>';

        return filters.onlyDelivered ? sales.filter(sale => sale.delivered_at !== null) : sales;
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

        toRender.length > 0 
        ? renderSales(toRender)
        : tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No hay ventas</td></tr>';
    }

    deliveredFilterBtn.addEventListener('click', () => applyFilters('onlyDelivered'));
    searchInput.addEventListener('input', () => applyFilters('search'));

</script>
@endsection