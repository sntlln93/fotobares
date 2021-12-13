@extends('layouts.app') @section('title', 'Inicio')

@section('content')

<div class="row">
    <div class="col-lg-6 px-0 mb-2">
        <div class="card-header px-0">
            <h6 class="h6 m-0 font-weight-bold text-primary">
                Cuotas por vencer
                <button class="btn btn-sm btn-info" id="togglePaymentsBtn"><i class="fas fa-eye"></i></button>
                <a href="{{ route('payments.index') }}" class="btn btn-sm btn-primary"><i
                        class="fas fa-hand-holding-usd"></i> Ver
                    todas</a>
            </h6>
        </div>
        <ul class="list-group" id="paymentsList">
            @forelse ($payments as $payment)
            <li class="list-group-item">
                <div class="d-flex flex-column">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a href="{{ route('clients.show', ['client'=> $payment->client->id]) }}">{{
                            $payment->client->full_name }}</a>
                    </p>
                    <p class="mb-0"><b>Cuota: </b> ${{ $payment->amount }}</p>
                    <p class="mb-0">
                        <b>Vencimiento:</b>
                        {{ $payment->due_date->isoFormat('D [de] MMMM Y') }}
                    </p>
                    <p class="mb-0">
                        <b>Hora:</b>
                        {{ $payment->hour}}
                    </p>

                    <p class="mb-2">
                        <b>Dirección:</b>
                        {{ $payment->client->address }}
                    </p>

                </div>
                <div class="d-flex justify-content-end">
                    @foreach ($payment->phones as $phone)
                    <a class="btn btn-sm btn-success ml-1" href="{{ route('whatsapp.send', ['phone' => $phone]) }}"
                        target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endforeach
                    @if ($payment->client->has_location)
                    <a class="btn btn-sm btn-warning ml-1" href="{{ url('map/' . $payment->client->id) }}">
                        <i class="fas fa-map-marker"></i>
                    </a>
                    @endif
                    <a class="btn btn-sm btn-primary ml-1"
                        href="{{ route('sales.show', ['sale' => $payment->sale_id]) }}">
                        <i class="fas fa-dollar-sign"></i>
                    </a>
                    <a class="btn btn-sm btn-info ml-1" href="{{ route('collect', ['sale' => $payment->sale_id]) }}">
                        <i class="fas fa-hand-holding-usd"></i>
                    </a>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                No hay cuotas por cobrar.
            </li>
            @endforelse
        </ul>
    </div>

    <div class="d-sm-none d-lg-block col-lg-1 mb-2"></div>

    <div class="col-lg-5 px-0 mb-2">
        <div class="px-0 card-header d-flex">
            <h6 class="h6 m-0 font-weight-bold text-primary">
                Próximas entregas
                <button class="btn btn-sm btn-info" id="toggleDeliveriesBtn"><i class="fas fa-eye"></i></button>
                <a href="{{ route('deliveries.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-box"></i> Ver
                    todas</a>
            </h6>
        </div>
        <ul class="list-group" id="deliveriesList">
            @forelse ($deliveries as $sale)
            <li class="list-group-item">
                <div class="d-flex flex-column w-100">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a href="{{ route('clients.show', ['client' => $sale->client_id]) }}">{{
                            $sale->client->full_name }}</a>
                    </p>
                    <p class="mb-0">
                        <b>Producto:</b>
                        @foreach ($sale->details as $detail)
                        @include('_partials.detail')
                        @endforeach
                    </p>
                    <p class="mb-0">
                        <b>Vendedor:</b>
                        {{ $sale->seller->full_name }}
                    </p>
                    <p class="mb-0">
                        <b>Dirección:</b>
                        <span>
                            {{ $sale->client->address->formatted_address }}
                            <a class="btn btn-sm btn-warning ml-1" href="{{ url('map/' . $sale->client_id) }}">
                                <i class="fas fa-map-marker"></i>
                            </a>
                        </span>
                    </p>
                    <p class="mb-2">
                        <b>Fecha de entrega:</b>
                        {{ $sale->deliver_on->isoFormat('D [de] MMMM Y') }}
                    </p>
                </div>
                <a class="w-100 btn btn-primary" href="{{ route('collect', ['sale' => $sale->id]) }}">Entregar</a>
            </li>
            @empty
            <li class="list-group-item">
                Todavía no hay entregas para mostrar.
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('click', (event) => {
        const element  = event.target;
        if(element.id === 'togglePaymentsBtn'){
            element.innerHTML = element.innerHTML === '<i class="fas fa-eye"></i>' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
            //toggle replace class btn-info for btn-warning
            element.classList.toggle('btn-info');
            element.classList.toggle('btn-secondary');
            document.getElementById('paymentsList').classList.toggle('d-none');
        }

        if(element.id === 'toggleDeliveriesBtn'){
            element.innerHTML = element.innerHTML === '<i class="fas fa-eye"></i>' ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
            element.classList.toggle('btn-info');
            element.classList.toggle('btn-secondary');
            document.getElementById('deliveriesList').classList.toggle('d-none');
        }
    })
</script>
@endsection