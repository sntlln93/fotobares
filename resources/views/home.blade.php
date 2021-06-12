@extends('layouts.app')

@section('styles')
    <style>
        .image-kid {
            width: 70%;
            margin: 0 auto 1em auto;
        }

        @media (min-width: 720px) {
            .image-kid {
                width: 50px;
            }
        }

    </style>
@endsection

@section('title', 'Inicio')

@section('content')

    <div class="row px-2">
        <div class="col-sm-12 col-md-6 pl-md-3 px-0 mb-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h4 mb-0 text-gray-800">Cuotas por vencer</h1>
            </div>
            <ul class="list-group">
                @forelse ($payments as $payment)
                    <li class="list-group-item d-flex align-items-center flex-wrap">
                        <div class="image-kid border rounded shadow-sm">
                            <img src="{{ $payment->photo_path }}" class="rounded img-fluid" alt="quixote" />
                        </div>
                        <div class="d-flex ml-3 flex-column">
                            <p class="mb-0">
                                <b>Cliente:</b>
                                <a
                                    href="{{ url('clients/' . $payment->client_id) }}">{{ $payment->client_full_name }}</a>
                            </p>
                            <p class="mb-0">
                                <b>Foto de:</b> {{ $payment->photo_description }}
                            </p>
                            <p class="mb-0">
                                <b>Saldo: </b> ${{ $payment->sale_balance }}
                            </p>
                            <p class="mb-0">
                                <b>Cuota: </b> ${{ $payment->payment_amount }}
                            </p>
                            <p class="mb-0">
                                <b>Vencimiento:</b>
                                {{ Carbon\Carbon::parse($payment->due_date)->diffForHumans() }}
                            </p>
                            <p class="mb-2">
                                <b>Hora:</b>
                                {{ $payment->visit_hour ? $payment->visit_hour : 'Sin hora de visita registrada' }}
                            </p>
                        </div>
                        <div class="ml-auto d-flex align-items-end">
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone=54{{ $payment->full_number }}&text=Hola%2C%20{{ $payment->client_first_name }}%21&source=&data=&app_absent="
                                class="btn btn-success ml-2"><i class="fab fa-whatsapp"></i></a>
                            @if ($payment->lat && $payment->lon)
                                <a href="{{ url('map/' . $payment->sale_id) }}" class="btn btn-warning ml-2"><i
                                        class="fas fa-map-marker"></i> Mapa</a>
                                @endif @if ($payment->delivered_at)
                                    <a href="{{ url('collect/' . $payment->client_id) }}" class="btn btn-primary ml-2"><i
                                            class="fas fa-dollar-sign"></i> Cobrar</a>
                                @else
                                    <a href="{{ url('deliver/' . $payment->sale_id) }}" class="btn btn-primary ml-2"><i
                                            class="fas fa-box"></i> Entregar</a>
                                @endif
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
                                <a href="{{ url('clients/' . $sale->client_id) }}">{{ $sale->client_full_name }}</a>
                            </p>
                            <p class="mb-0">
                                <b>Producto:</b>
                                @foreach ($sale->ordered_products as $quantity => $name)
                                    <span class="badge badge-info">
                                        {{ $name }} <span
                                            class="badge badge-pill badge-light">{{ $quantity }}</span>
                                    </span>
                                @endforeach
                                ({{ $sale->quantity_of_products }} en total)
                            </p>
                            <p class="mb-2">
                                <b>Fecha:</b>
                                {{ Carbon\Carbon::parse($sale->sold_at)->diffForHumans() }}
                            </p>
                        </div>
                        <div class="ml-auto d-flex align-items-end p-2 bg-success rounded">
                            <p class="text-white my-auto">
                                <b>${{ $sale->amount }}</b>
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
