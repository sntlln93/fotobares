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
    <table class="table table-bordered">
        <thead>
            <tr class="card-header">
                <th colspan="8">
                    <div class="py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>
                    </div>
                </th>
            </tr>
            <tr>
                <th>Detalle</th>
                <th>Cliente</th>
                <th>Descripción</th>
                <th>Entrega programada</th>
                <th>Fecha venta</th>
                <th>Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white">

        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/utils/time.js') }}"></script>

<script>
    const sales = @json($details);
    const tableBody = document.querySelector('tbody');
    const addPhotoUrl = "{{ route('without-photo.edit', ['detail' => ':detail']) }}";
    const showClientBaseUrl = '{{ route('clients.show', ':client') }}';

    const renderSales = (detailsToRender) => {
        tableBody.innerHTML = '';

        detailsToRender.forEach(detail => {
            const tr = document.createElement('tr');

            tr.innerHTML = `
                <td>${detail.id}</td>
                <td><a href="${showClientBaseUrl.replace(':client', detail.sale.client.id)}">${detail.sale.client.name} ${detail.sale.client.lastname}</a></td>
                <td>${detail.description}</td>
                <td>${getFormattedDate(detail.sale.deliver_on)}</td>
                <td>${getTimeAgo(new Date(detail.sale.created_at))}</td>
                <td>
                    <p class="my-0"><strong>${detail.product.name}</strong>
                        <i class="fas fa-circle color-indicator"
                            style="color: ${detail.color}; background-color: ${detail.color}">
                        </i>
                        ${detail.code ? `[${detail.code}]` : ''}
                    </p>
                </td>
                <td>
                    <a href="${addPhotoUrl.replace(':detail', detail.id)}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i>
                        Agregar foto
                    </a>
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

    const applyFilters = (filterName) => {       
        tableBody.innerHTML = '<tr><td colspan="7" class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></td></tr>';
        
        let toRender = sales;
            
        if(filterName === 'search') {
            filters[filterName] = searchInput.value === "" ? false : true;
            toRender = searchOnSales();
        }

        toRender.length > 0 
        ? renderSales(toRender)
        : tableBody.innerHTML = '<tr><td colspan="7" class="text-center">No hay ventas</td></tr>';
    }

    searchInput.addEventListener('input', () => applyFilters('search'));

</script>
@endsection