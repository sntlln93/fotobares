@extends('layouts.app') @section('title', 'Inicio') @section('content')

<div class="row">
    <div class="col-lg-6 px-0 mb-2">
        <div class="card-header px-0">
            <h6 class="h6 m-0 font-weight-bold text-primary">Cuotas por vencer</h6>
        </div>
        <ul class="list-group">
            @forelse ($sales as $sale)
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
                        <a href="{{ route('clients.show', ['client'=> $sale->id]) }}">{{ $sale->client->full_name }}</a>
                    </p>
                    <p class="mb-0"><b>Cuota: </b> ${{ $sale->nextPaymentToCollect->amount }}</p>
                    <p class="mb-0">
                        <b>Vencimiento:</b>
                        {{ $sale->nextPaymentToCollect->formatted_due_date }}
                    </p>
                    <p class="mb-0">
                        <b>Hora:</b>
                        {{ $sale->nextPaymentToCollect->hour}}
                    </p>

                    <p class="mb-2">
                        <b>Producto (descripción):</b>
                        @foreach ($sale->details as $detail)
                        <span class="badge badge-info">{{ $detail->product->name }} ({{ $detail->description }})</span>
                        @endforeach
                    </p>
                </div>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" id="paymentDropdown{{ $sale->id }}" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <!-- Dropdown - User Information -->

                    <div class="
                                dropdown-menu dropdown-menu-right
                                shadow
                                animated--grow-in
                            " aria-labelledby="paymentDropdown{{ $sale->nextPaymentToCollect->id }}">
                        @foreach ($sale->client->phones as $phone)
                        <a href="{{ route('whatsapp.send', ['phone' => $phone->id]) }}" class="dropdown-item"
                            target="_blank">
                            <div class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            Enviar whatsapp
                        </a>
                        @endforeach
                        @if ($sale->client->address->has_location)
                        <a href="{{ url('map/' . $sale->id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-warning">
                                <i class="fas fa-map-marker"></i>
                            </div>
                            Ver en mapa
                        </a>
                        @endif
                        <a href="{{ route('collect', ['sale' => $sale->id]) }}" class="dropdown-item">
                            @if ($sale->delivered_at)
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

                <div class="d-flex flex-column">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a
                            href="{{ route('clients.show', ['client' => $sale->client_id]) }}">{{ $sale->client->full_name }}</a>
                    </p>
                    <p class="mb-0">
                        <b>Producto:</b>
                        @foreach ($sale->details as $detail)
                        <span class="badge badge-info">{{ $detail->product->name }} ({{ $detail->description }})</span>
                        @endforeach
                    </p>
                    <p class="mb-2">
                        <b>Fecha:</b>
                        {{ $sale->created_at->diffForHumans() }}
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
                        <b>${{ $sale->details->sum('amount') }}</b>
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