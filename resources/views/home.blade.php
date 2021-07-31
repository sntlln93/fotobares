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
                            href="{{ route('clients.show', ['client'=> $payment->client_id]) }}">{{ $payment->client_name }}</a>
                    </p>
                    <p class="mb-0"><b>Cuota: </b> ${{ $payment->amount }}</p>
                    <p class="mb-0">
                        <b>Vencimiento:</b>
                        {{ $payment->due_date }}
                    </p>
                    <p class="mb-2">
                        <b>Hora:</b>
                        {{ $payment->hour}}
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
                        <a href="{{ route('whatsapp.send', ['phone' => $payment->phone_id]) }}" class="dropdown-item"
                            target="_blank">
                            <div class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            Enviar whatsapp
                        </a>
                        @if ($payment->has_location)
                        <a href="{{ url('map/' . $payment->sale_id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-warning">
                                <i class="fas fa-map-marker"></i>
                            </div>
                            Ver en mapa
                        </a>
                        @endif
                        <a href="{{ route('collect', ['sale' => $payment->sale_id]) }}" class="dropdown-item">
                            @if ($payment->delivered_at == false)
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
            @forelse ($sales as $sale)
            <li class="list-group-item d-flex align-items-center flex-wrap">

                <div class="d-flex ml-3 flex-column">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a
                            href="{{ route('clients.show', ['client' => $sale->client->id]) }}">{{ $sale->client->full_name }}</a>
                    </p>
                    <p class="mb-0">
                        <b>Producto:</b>
                        @foreach ($sale->details as $detail)
                        <span class="badge badge-info">
                            {{ $detail->product->name }}
                        </span>
                        @endforeach
                    </p>
                    <p class="mb-2">
                        <b>Fecha:</b>
                        {{ Carbon\Carbon::parse($sale->created_at)->diffForHumans() }}
                    </p>
                </div>
                <div class="
                            ml-auto
                            d-flex
                            align-items-end
                            p-2
                            bg-success
                            rounded
                        ">
                    <p class="text-white my-auto">
                        <b>${{ $sale->details_sum_amount }}</b>
                    </p>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                Todavía no hay ventas para mostrar. Genera una
                <a href="{{ route('sales.create') }}">acá</a>.
            </li>
            @endforelse
        </ul>
    </div>
</div>
@endsection