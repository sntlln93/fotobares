@extends('layouts.app') @section('title', 'Inicio') @section('content')

<div class="row">
    <div class="col-lg-6 px-0 mb-2">
        <div class="card-header px-0">
            <h6 class="h6 m-0 font-weight-bold text-primary">Cuotas por vencer</h6>
        </div>
        <ul class="list-group">
            @forelse ($payments as $payment)
            <li class="
                        list-group-item
                        d-flex
                        justify-content-between
                        align-items-start
                        flex-wrap
                    ">

                <div class="d-flex flex-column">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a
                            href="{{ route('clients.show', ['client'=> $payment->client->id]) }}">{{ $payment->client->full_name }}</a>
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
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" id="paymentDropdown{{ $payment->sale_id }}" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <!-- Dropdown - User Information -->

                    <div class="
                                dropdown-menu dropdown-menu-right
                                shadow
                                animated--grow-in
                            " aria-labelledby="paymentDropdown{{ $payment->id }}">
                        @foreach ($payment->phones as $phone)
                        <a href="{{ route('whatsapp.send', ['phone' => $phone]) }}" class="dropdown-item"
                            target="_blank">
                            <div class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            Enviar whatsapp
                        </a>
                        @endforeach
                        @if ($payment->client->has_location)
                        <a href="{{ url('map/' . $payment->client->id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-warning">
                                <i class="fas fa-map-marker"></i>
                            </div>
                            Ver en mapa
                        </a>
                        @endif
                        <a href="{{ route('collect', ['sale' => $payment->sale_id]) }}" class="dropdown-item">
                            @if ($payment->delivered_at)
                            <div class="btn btn-sm btn-primary">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            Cobrar
                            @else
                            <div class="btn btn-sm btn-primary">
                                <i class="fas fa-box"></i>
                            </div>
                            Entregar
                            @endif
                        </a>
                    </div>
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
            <h6 class="h6 m-0 font-weight-bold text-primary">Últimas ventas</h6>
        </div>
        <ul class="list-group">
            @include('sales._sales-list')
        </ul>
    </div>
</div>
@endsection