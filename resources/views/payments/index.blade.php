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

<div class="card-grid">
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/utils/time.js') }}"></script>
<script src="{{ asset('js/utils/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/utils/flatpickr.l10n.min.js') }}"></script>

<script>
    const grid = document.querySelector('.card-grid');
    const payments = Object.values(@json($payments)).sort((a, b) => new Date(a.due_date) - new Date(b.due_date));
    const routes = {
        client:'{{ route('clients.show', ['client' => ':client']) }}',
        whatsapp:'{{ route('whatsapp.send', ['phone' => ':phone']) }}',
        map: '{{ route('map.show', ['client' => ':client']) }}',
        sales: {
            show: '{{ route('sales.show', ['sale' => ':sale']) }}',
            collect: '{{ route('collect', ['sale' => ':sale']) }}',
        },
    }
    
    const createBtns = (payment) => {
        const phones = payment.phones.reduce((acc, phone) => {
            return acc += `<a class="btn btn-sm btn-success ml-1" href="${routes.whatsapp.replace(':phone', phone)}" target="_blank"><i class="fab fa-whatsapp"></i></a>`;
        }, '');

        const mapBtn = payment.client.has_location ? `<a class="btn btn-sm btn-warning ml-1" href="${routes.map.replace(':client', payment.client.id)}"><i class="fas fa-map-marker"></i></a>` : '';
        
        return `
            ${phones}
            ${mapBtn}
            <a class="btn btn-sm btn-primary ml-1" href="${ routes.sales.show.replace(':sale', payment.sale_id) }">
                <i class="fas fa-dollar-sign"></i>
            </a>
            <a class="btn btn-sm btn-info ml-1" href="${ routes.sales.collect.replace(':sale', payment.sale_id) }">
                <i class="fas fa-hand-holding-usd"></i>
            </a>`;
    }

    const renderPayments = (payments) => {
        grid.innerHTML = '';
        payments.forEach(payment => {
            const card = document.createElement('div');
            card.classList = 'card';
            card.innerHTML = `
                <div class="card-header text-right">
                    ${createBtns(payment)}                
                </div>
                <div class="card-body">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a href="${ routes.client.replace(':client', payment.client.id) }">${
                            payment.client.full_name }</a>
                    </p>
                    <p class="mb-0"><b>Cuota: </b> $${ payment.amount }</p>
                    <p class="mb-0">
                        <b>Vencimiento:</b>
                        ${ getFormattedDate(payment.due_date) }
                    </p>
                    <p class="mb-0">
                        <b>Hora:</b>
                        ${ payment.hour}
                    </p>

                    <p class="mb-2">
                        <b>Dirección:</b>
                        ${ payment.client.address }
                    </p>
                </div>`;

            grid.appendChild(card);
        });
    }

    renderPayments(payments);
</script>

<script>
    const filterByDateRange = (selectedDates) => {
        const filteredPayments = payments.filter(p => new Date(p.due_date) >= new Date(selectedDates[0]) && new Date(p.due_date) <= new Date(selectedDates[1]))
        renderPayments(filteredPayments);
    };

    flatpickr("#dateRangeFilterBtn", {
    "locale": "es",
    mode: "range",
    dateFormat: "d/M",
    onOpen: function() {
        document.querySelector("#dateRangeFilterBtn").removeAttribute('value');
    },
    onValueUpdate: function(selectedDates, dateStr) {
        const filterPaymentsByDateBtn = document.querySelector("#dateRangeFilterBtn");

        filterPaymentsByDateBtn.querySelector('span').innerText = dateStr;

        filterByDateRange(selectedDates);
        selectedDates.length && filterPaymentsByDateBtn.classList.add('filter--active');
    },
});

//cleaning selection
document.querySelector('.clear_button').addEventListener('click', function() {
    const filterPaymentsByDateBtn = document.querySelector("#dateRangeFilterBtn");

    filterPaymentsByDateBtn.querySelector('span').innerText = 'Fechas';
    filterPaymentsByDateBtn.classList.remove('filter--active');
    filterPaymentsByDateBtn.flatpickr().clear();
    renderPayments(payments);
  });

  //search on payments
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

    const searchOnPayments = () => {
        const params = searchInput.value.toLowerCase();
        const toRender = payments.filter(payment => Object.values(flattenObj(payment)).some(p => String(p).toLowerCase().includes(params)));
        
        toRender.length > 0
        ? renderPayments(toRender)
        : grid.innerHTML = 'No hay pagos que coincidan con la búsqueda';
    }

    searchInput.addEventListener('input', searchOnPayments);

</script>
@endsection