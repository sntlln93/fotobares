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
                        <h5 class="card-title">
                            Cliente
                            <a href="{{ route('clients.edit', ['client' => $sale->client_id]) }}"
                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('clients.show', ['client' => $sale->client_id]) }}"
                                class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                        </h5>
                        <hr>
                        <div class="card-text">
                            <p><strong>Apellido y nombre:</strong> <a
                                    href="{{ route('clients.show', ['client' => $sale->client_id]) }}">{{
                                    $sale->client->full_name }}</a>
                            </p>
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
                        <h5 class="card-title">
                            Información de la venta
                        </h5>
                        <hr>
                        <div class="card-text">
                            <p><strong>Fecha de venta:</strong> {{ $sale->created_at->isoFormat('D [de] MMMM Y')
                                }}
                            </p>
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
                                @include('_partials.color')
                                @if($detail->code)
                                <span class="badge badge-info">{{ strtoupper($detail->code) }}</span>
                                @endif -
                                ${{ number_format($detail->amount, 2, ',', '.') }}
                                @if($detail->photo)
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#showPhotoModal{{ $detail->id }}">
                                    <i class="fas fa-image"></i>
                                </button>
                            <div class="modal fade" id="showPhotoModal{{ $detail->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="showPhotoModal{{ $detail->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="showPhotoModal{{ $detail->id }}Label">
                                                {{ $detail->description }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <img class="img-fluid" src="{{ asset('storage/'.$detail->photo->path) }}"
                                                alt="{{ $detail->description }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pagos <a href="{{ route('recalculate.form', ['sale' => $sale->id]) }}"
                                class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a></h5>
                        @foreach ($sale->payments as $payment)
                        <hr>
                        <div class="card-text">
                            <p class="mb-0"><strong>Vencimiento:</strong>
                                {{ $payment->due_date->isoFormat('D [de] MMMM Y') }}</p>
                            <p class="mb-0"><strong>Monto:</strong> ${{ number_format($payment->amount, 2, ',',
                                '.')
                                }}
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