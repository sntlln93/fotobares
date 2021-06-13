@extends('layouts.app')
@section('title', 'Inicio')

@section('content')

<div class="row px-2">
    <div class="col-sm-12 col-md-6 pl-md-3 px-0 mb-5">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Cuotas por vencer</h1>

        </div>
        <ul class="list-group">
            @forelse ($payments as $payment)
            <li class="list-group-item d-flex justify-content-around align-items-start flex-wrap">
                <div class="border rounded shadow-sm mb-4">
                    <img src="https://via.placeholder.com/350x150" class="rounded img-fluid" alt="quixote" />
                </div>
                <div class="d-flex flex-column">
                    <p class="mb-0">
                        <b>Cliente:</b>
                        <a
                            href="{{ route('clients.show', ['client'=> $payment->client_id]) }}">{{ $payment->client_name }}</a>
                    </p>
                    <p class="mb-0">
                        <b>Cuota: </b> ${{ $payment->amount }}
                    </p>
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

                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="paymentDropdown{{ $payment->id }}">
                        <a href="https://api.whatsapp.com/send?phone=54{{ $payment->number }}&text=Hola%2C%20{{ $payment->client_name }}%21&source=&data=&app_absent="
                            class="dropdown-item" target="_blank">
                            <div class="btn btn-sm btn-success "><i class="fab fa-whatsapp"></i></div>
                            Enviar whatsapp
                        </a>
                        @if ($payment->has_location)
                        <a href="{{ url('map/' . $payment->sale_id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-warning"><i class="fas fa-map-marker"></i></div>
                            Ver en mapa
                        </a>
                        @endif
                        @if ($payment->delivered_at)
                        <a href="{{ url('collect/' . $payment->client_id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-primary"><i class="fas fa-dollar-sign"></i></div>
                            Cobrar
                        </a>
                        @else
                        <a href="{{ url('deliver/' . $payment->sale_id) }}" class="dropdown-item">
                            <div class="btn btn-sm btn-primary"><i class="fas fa-box"></i></div>
                            Entregar
                        </a>
                        @endif
                    </div>
                </div>
            </li>
            @empty
            <li class="list-group-item">No hay pagos por cobrar</li>
            @endforelse
        </ul>
    </div>

    <div class="col-sm-12 col-md-6 pl-md-3 px-0 mb-5">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800">Últimas ventas</h1>
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
                <div class="ml-auto d-flex align-items-end p-2 bg-success rounded">
                    <p class="text-white my-auto">
                        <b>${{ $sale->details_sum_amount }}</b>
                    </p>
                </div>
            </li>
            @empty
            <li class="list-group-item">Todavía no hay ventas para mostrar. Genera una <a
                    href="{{ route('sales.create') }}">acá</a>.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection