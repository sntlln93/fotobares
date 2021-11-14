@extends('layouts.app')

@section('title', 'Ventas')

@section('styles')
<style>
    .card-max-width {
        margin-block: .8em;
    }
</style>
@endsection

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">Fabricación</h3>
    <a href="#" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-file-pdf fa-lg mr-1"></i>
        Imprimir</a>
</div>

<div class="input-group mb-2">
    <input type="text" class="form-control" id="searchInput">
    <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
</div>
<div class="d-flex flex-wrap" id="details">

</div>
@endsection

@section('scripts')
<script>
    const details = @json($details);
    const baseURL = @json(url('/'));
    const detailsContainer = document.querySelector('#details');

    const render = (details) => {
        detailsContainer.innerHTML = '';
        
        details.forEach((detail, index) => {
            const markAsManufacturedUrl = detail.manufactured_at ? "{{ route('manufacture.undo', ':detail') }}" : "{{ route('manufacture.update', ':detail') }}";
            console.log(markAsManufacturedUrl);

        const submitBtnContent = detail.manufactured_at
        ? `<i class="fas fa-exclamation-circle"></i> Desmarcar como fabricado`
        : `<i class="fas fa-tools"></i> Marcar como fabricado`;

        const submitBtn = `<button type="submit" class="btn ${detail.manufactured_at ? "btn-danger" : "btn-primary"} mt-4">${submitBtnContent}</button>`;

        const formHTML = `
        <form action="${markAsManufacturedUrl.replace(':detail', detail.id)}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            ${submitBtn}
        </form>
        `;

            const card = document.createElement('div');
            card.classList.add('card', 'col-md-6', 'col-lg-4', 'card-max-width', 'p-0');
            card.innerHTML = `
                <img loading="${index < 3 ? 'lazy' : 'eager'}" src="${baseURL}/storage/${detail.photo.path}" class="card-img-top" alt="${detail.description}">
                <div class="card-body">
                    <h5 class="card-title">
                        [${detail.sale_id}] ${detail.product.name} <i
                            class="fas fa-circle ${detail.color}-text"></i>
                    </h5>
                    <p class="card-text mb-0"><strong>Descripción: </strong>${detail.description}</p>
                    <p class="card-text mb-0"><strong>Color: </strong>${detail.color}</p>
                    <p class="card-text mb-0"><strong>Código: </strong>${detail.code || "-"}</p>
                    ${formHTML}
                </div>
            `;

            detailsContainer.appendChild(card);
        });
    }



    render(details);
</script>

<script>
    const searchInput = document.querySelector('#searchInput');

    const filters = {
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

    const searchOnDetails = () => {
        const params = searchInput.value.toLowerCase();
        return details.filter(sale => Object.values(flattenObj(sale)).some(s => String(s).toLowerCase().includes(params)));
    }

    const applyFilters = (filterName) => {       
        detailsContainer.innerHTML = '<div class="card w-100 text-center"><div class="card-body"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div></div>';
        
        let toRender = details;
            
        if(filterName === 'search') {
            filters[filterName] = searchInput.value === "" ? false : true;
            toRender = searchOnDetails();
        }

        toRender.length > 0 
        ? render(toRender)
        : detailsContainer.innerHTML = '<div class="card w-100 text-center"><div class="card-body">No hay coincidencias</div></div>';
    }

    searchInput.addEventListener('input', () => applyFilters('search'));
</script>
@endsection