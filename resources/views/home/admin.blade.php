@extends('layouts.app') @section('title', 'Inicio')

@section('styles')
<style>
    .fas,
    .fas {
        pointer-events: none;
    }
</style>
@endsection


@section('content')

<div class="row">
    <div class="col-lg-6 px-0 mb-2">
        <div class="card-header px-0">
            <h6 class="h6 m-0 font-weight-bold text-primary">
                Cuotas por vencer
                <button class="btn btn-sm rounded-lg bg-secondary text-white border" id="togglePaymentsBtn"><i
                        class="fas fa-eye"></i></button>
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
                        <b>Producto (descripción):</b>
                        @foreach ($payment->details as $detail)
                        <span class="badge text-white {{ $detail->color }}">{{ $detail->product_name }}
                            {{ $detail->description ? '('.$detail->description.')' : '(-)'}}</span>
                        @endforeach
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
                    <a class="btn btn-sm btn-primary ml-1" href="{{ route('collect', ['sale' => $payment->sale_id]) }}">
                        @if ($payment->delivered_at)
                        <i class="fas fa-dollar-sign"></i>
                        @else
                        <i class="fas fa-box"></i>
                        @endif
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
                <button class="btn btn-sm rounded-lg bg-secondary text-white border" id="toggleDeliveriesBtn"><i
                        class="fas fa-eye"></i></button>
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
                        <span class="badge text-white {{ $detail->color }}">{{ $detail->product->name }}
                            {{ $detail->description ? '('.$detail->description.')' : '(-)'}}</span>
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
        if(event.target.id === 'togglePaymentsBtn'){
            document.getElementById('paymentsList').classList.toggle('d-none');
        }

        if(event.target.id === 'toggleDeliveriesBtn'){
            document.getElementById('deliveriesList').classList.toggle('d-none');
        }
    })
</script>
@endsection