@extends('layouts.app')

@section('title', 'Venta')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Venta</h6>
    </div>
    <div class="card-body">
        <div class="row g-5">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Cliente</h5>
                        <hr>
                        <div class="card-text">
                            <p><strong>Apellido y nombre:</strong> {{ $sale->client->full_name }}</p>
                            <p><strong>DNI:</strong> {{ $sale->client->dni }}</p>
                            <p><strong>Teléfonos:</strong>
                                @foreach ($sale->client->phones as $phone)
                                <a href="tel:{{ $phone->area_code.$phone->number }}">
                                    <span class="badge badge-info">{{ $phone->formatted_number }}</span>
                                </a>
                                @endforeach
                            </p>
                            <p><strong>Dirección:</strong>
                                {{ $sale->client->address->formatted_address }}
                                <a class="btn btn-sm btn-warning"
                                    href="{{ route('map.show', ['client' => $sale->client_id]) }}"><i
                                        class="fas fa-map-marker"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Información de la venta</h5>
                        <hr>
                        <div class="card-text">
                            <p><strong>Fecha de venta:</strong> {{ $sale->created_at->isoFormat('D [de] MMMM Y') }}</p>
                            <p><strong>Fecha de entrega programada:</strong>
                                {{ $sale->deliver_on->isoFormat('D [de] MMMM Y') }}</p>
                            <p><strong>Fecha de entrega:</strong> {{ $sale->delivered_at }}</p>
                            <p><strong>Vendedor:</strong>
                                <a href="{{ route('employees.show', ['employee' => $sale->seller_id]) }}">
                                    {{ $sale->seller->full_name }}</span>
                                </a>
                            </p>
                            @if($sale->payment_description)
                            <p><strong>Información para los pagos:</strong>
                                {{ $sale->payment_description }}
                            </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detalles</h5>
                        <hr>
                        <div class="card-text">
                            @foreach ($sale->details as $detail)
                            <p class="my-0"><strong>{{ $detail->product->name }}</strong>
                                [color {{ strtolower($detail->color) }}] -
                                ${{ number_format($detail->amount, 2, ',', '.') }}
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pagos</h5>
                        @foreach ($sale->payments as $payment)
                        <hr>
                        <div class="card-text">
                            <p class="mb-0"><strong>Vencimiento:</strong>
                                {{ $payment->due_date->isoFormat('D [de] MMMM Y') }}</p>
                            <p class="mb-0"><strong>Monto:</strong> ${{ number_format($payment->amount, 2, ',', '.') }}
                            </p>
                            <p class="mb-0"><strong>Fecha de pago:</strong> {{ $payment->paid_at }}</p>
                            <p class="mb-0"><strong>Hora de visita:</strong> {{ $payment->hour }}</p>
                            @if($payment->collector_id)
                            <p class="mb-0"><strong>Cobrador:</strong>
                                <a href="{{ route('employees.show', ['employee' => $payment->collector_id]) }}">
                                    {{ $payment->collector->full_name }}</span>
                                </a>
                            </p>
                            @endif
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection