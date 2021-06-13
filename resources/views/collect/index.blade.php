@extends('layouts.app')

@section('title', 'Cobrar')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <h1 class="h4 mb-0 text-gray-800">Cuotas de {{ $sale->client->full_name }}</h1>
        <ul class="list-group">
            <li class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                    flex-wrap
                ">
                <div>
                    @if($sale->payment_description)
                    <p class="my-0">
                        <strong>Información para los pagos:</strong>
                        {{ $sale->payment_description }}
                    </p>
                    @endif
                </div>
                <div class="d-flex">
                    @if ($sale->delivered_at)
                    <a href="{{ route('deliver.form', ['sale' => $payment->sale_id]) }}" class="mx-1">
                        <div class="btn btn-sm btn-primary">
                            <i class="fas fa-box"></i>
                        </div>
                    </a>
                    @endif
                </div>
            </li>
        </ul>
    </div>
    <div class="col-lg-6">
        <h1 class="h4 mb-0 text-gray-800">Cuotas de {{ $sale->client->full_name }}</h1>
        <ul class="list-group">
            @foreach ($sale->payments as $payment)
            <li class="
                    list-group-item
                    d-flex
                    justify-content-between
                    align-items-center
                    flex-wrap
                ">
                <div>
                    <p class="my-0"><strong>Vencimiento:</strong> {{ $payment->due_date->isoFormat('D [de] MMMM Y') }}
                    </p>
                    <p class="my-0">
                        <strong>Monto:</strong>
                        ${{ number_format($payment->amount, 2, '.', ',') }}
                    </p>
                    @if($payment->paid_at)
                    <p class="my-0"><strong>Fecha de pago:</strong> {{ $payment->paid_at }}</p>
                    <p class="my-0">
                        <strong>Cobrador:</strong>
                        <a href="{{ route('employees.show', ['employee' => $payment->collector_id]) }}">
                            {{ $payment->collector->full_name }}</span>
                        </a>
                    </p>
                    @endif
                    @if($sale->payment_description)
                    <p class="my-0">
                        <strong>Información para los pagos:</strong>
                        {{ $sale->payment_description }}
                    </p>
                    @endif
                </div>
                <div class="d-flex">
                    @foreach ($sale->client->phones as $phone)
                    <a href="https://api.whatsapp.com/send?phone=54{{ $phone->formatted_number }}&text=Hola%2C%20{{ $sale->client->full_name }}%21&source=&data=&app_absent="
                        class="mx-1" target="_blank">
                        <div class="btn btn-sm btn-success">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                    </a>
                    @endforeach
                    @if ($sale->client->address->has_location)
                    <a href="{{ route('map.show', ['client' => $sale->client_id]) }}" class="mx-1">
                        <div class="btn btn-sm btn-warning">
                            <i class="fas fa-map-marker"></i>
                        </div>
                    </a>
                    @endif
                    @if ($sale->delivered_at)
                    <a href="{{ route('deliver.form', ['sale' => $payment->sale_id]) }}" class="mx-1">
                        <div class="btn btn-sm btn-primary">
                            <i class="fas fa-box"></i>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('collect.form', ['payment' => $payment->id]) }}" class="mx-1">
                        <div class="btn btn-sm btn-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </a>
                    @endif
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection