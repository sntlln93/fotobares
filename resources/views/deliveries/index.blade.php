@extends('layouts.app')

@section('title', 'Entregas')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/utils/flatpickr.min.css') }}">
<style>
    .card-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 1fr);
        grid-gap: 5px;

    }

    @media (max-width: 968px) {
        .card-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .card-grid {
            grid-template-columns: repeat(1, 1fr);
            grid-template-rows: repeat(1, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="input-group col-sm-12 col-md-6 mb-2">
        <input type="text" class="form-control" id="searchInput">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 mb-2">
        <button id="dateRangeFilterBtn" class="btn btn-sm btn-light border h-100">
            <span>Fechas</span>
            <i class="fas fa-calendar-alt"></i>
        </button>
        <button class="btn btn-sm btn-light border h-100 clear_button" title="clear" data-clear>
            <i class="text-danger fas fa-minus-circle"></i>
        </button>
    </div>
</div>

<div class="card-grid"></div>

@endsection

@section('scripts')
<script src="{{ asset('js/utils/time.js') }}"></script>
<script src="{{ asset('js/utils/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/utils/flatpickr.l10n.min.js') }}"></script>

<script>
    const sales = Object.values(@json($sales)).sort((a, b) => new Date(a.due_date) - new Date(b.due_date));
    const grid = document.querySelector('.card-grid');

    const routes = {
        client:'{{ route('clients.show', ['client' => ':client']) }}',
        whatsapp:'{{ route('whatsapp.send', ['phone' => ':phone']) }}',
        images: '{{ asset('storage/'. ':path') }}',
        sales: {
            show: '{{ route('sales.show', ['sale' => ':sale']) }}',
            collect: '{{ route('collect', ['sale' => ':sale']) }}',
        },
    }

    const rendersales = (sales) => {
        grid.innerHTML = '';
        sales.forEach(sale => {
            const phoneBtns = sale.client.phones.reduce((acc, phone) => {
                return acc + `<a class="btn btn-sm btn-success ml-1" href="${ routes.whatsapp.replace(':phone', phone.id) }" target="_blank">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="tel:${ phone.full_number }" class="btn btn-sm btn-primary"><i class="fas fa-phone"></i></a>`;
            }, '');

            const detailBadges = sale.details.reduce((acc, detail) => {
                return acc + `<a href="${ routes.sales.show.replace(':sale', detail.sale_id) }">
                    <span class="badge badge-light border--transparent">${ detail.product.name }
                        ${ detail.description ? '(' + detail.description + ')' : '(-)'}
                        <i class="fas fa-circle color-indicator"
                            style="color: ${ detail.color }; background-color: ${ detail.color }">
                        </i>
                    </span>
                </a>`;
            }, '');

            const card = document.createElement('div');
            card.classList = 'card';
            card.innerHTML = `
                <div class="card-header text-right">
                    <button type="button" class="btn btn-sm btn-primary" data-open="modal"
                        data-target="#photo${ sale.id }"><i class="fas fa-image"></i></button>
                    <button class="btn btn-sm btn-warning ml-1" data-map-model="${ sale.client.id }"
                        data-map-add="delivery">
                        <i class="fas fa-map-marker"></i>
                    </button>
                    ${phoneBtns}
                    <a href="${ routes.sales.show.replace(':sale', sale.id) }" class="btn btn-sm btn-dark"><i
                            class="fas fa-credit-card"></i></a>
                    <a href="${ routes.sales.show.replace(':sale', sale.id) }" class="text-uppercase btn btn-sm btn-info"><i
                            class="fas fa-eye"></i> Ver</a>
                </div> 

                <div class="card-body">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a href="${ routes.client.replace(':client', sale.client.id) }">${
                            sale.client.full_name }</a>
                    </p>
                    <p class="mb-0">
                        <b>Producto:</b>
                        ${detailBadges}
                    </p>
                    <p class="mb-0">
                        <b>Vendedor:</b>
                        ${ sale.seller.full_name }
                    </p>
                    <p class="mb-0">
                        <b>Dirección:</b>
                        <span>
                            ${ sale.client.address.formatted_address }
                        </span>
                    </p>
                    <p class="mb-2">
                        <b>Fecha de entrega:</b>
                        ${ getFormattedDate(sale.deliver_on) }
                    </p>
                    <a class="w-100 btn btn-primary" href="${ routes.sales.collect.replace(':sale', sale.id) }">Entregar</a>
                </div>`;

            grid.appendChild(card);
        });
    }

    rendersales(sales);
</script>

<script>
    const filterByDateRange = (selectedDates) => {
        const filteredsales = sales.filter(s => new Date(s.deliver_on) >= new Date(selectedDates[0]) && new Date(s.deliver_on) <= new Date(selectedDates[1]))
        rendersales(filteredsales);
    };

    flatpickr("#dateRangeFilterBtn", {
        "locale": "es",
        mode: "range",
        dateFormat: "d/M",
        onOpen: function() {
            document.querySelector("#dateRangeFilterBtn").removeAttribute('value');
        },
        onValueUpdate: function(selectedDates, dateStr) {
            const filtersalesByDateBtn = document.querySelector("#dateRangeFilterBtn");

            filtersalesByDateBtn.querySelector('span').innerText = dateStr;

            filterByDateRange(selectedDates);
            selectedDates.length && filtersalesByDateBtn.classList.add('filter--active');
        },
    });

    //cleaning selection
    document.querySelector('.clear_button').addEventListener('click', function() {
        const filtersalesByDateBtn = document.querySelector("#dateRangeFilterBtn");

        filtersalesByDateBtn.querySelector('span').innerText = 'Fechas';
        filtersalesByDateBtn.classList.remove('filter--active');
        filtersalesByDateBtn.flatpickr().clear();
        rendersales(sales);
    });

    //search on sales
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

    const searchOnsales = () => {
        const params = searchInput.value.toLowerCase();
        const toRender = sales.filter(payment => Object.values(flattenObj(payment)).some(p => String(p).toLowerCase().includes(params)));
        
        toRender.length > 0
        ? rendersales(toRender)
        : grid.innerHTML = 'No hay entregas que coincidan con la búsqueda';
    }

    searchInput.addEventListener('input', searchOnsales);
</script>


<script>
    const openModal = (sale) => {
        const modal = document.createElement('div');

        const modalBody = sale.details.reduce((acc, detail) => {
            return acc + `<img src="${ routes.images.replace(':path', detail?.photo?.path) }" alt="" class="img-fluid">`;
        }, '');

        modal.classList = 'modal fade';
        modal.id = `photo${ sale.id }`;
        modal.ariaLabelledby = 'photo${sale.id}Label';
        modal.setAttribute('data-close-modal', modal.id);
        modal.innerHTML = `
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="photo${sale.id}Label">Fotos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" data-close-modal=${modal.id}>
                            <span aria-hidden="true" data-close-modal=${modal.id}>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ${modalBody}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-close-modal=${modal.id}>Close</button>
                    </div>
                </div>
            </div>`;

        document.body.appendChild(modal);
        $(`#${modal.id}`).modal('show');
    };

    //for open and closing modals
    document.addEventListener('click', e => {
        const target =  e.target;

        if(target.hasAttribute('data-open')){
            const sale = sales.find(s => s.id === parseInt(target.getAttribute('data-target').replace('#photo', '')));
            openModal(sale);
        }

        if(target.hasAttribute('data-close-modal')) {
            console.log(target.getAttribute('data-close-modal'));
            const toRemove = document.getElementById(target.getAttribute('data-close-modal'));
            document.body.removeChild(toRemove);
        }
    });
</script>

@endsection