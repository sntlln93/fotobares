@extends('layouts.app')

@section('title', 'Cobrar')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 mb-0 text-gray-800">Cuotas de {{ $sale->client->full_name }}</h1>

    <div>
        <a href="{{ route('clients.show', ['client' => $sale->client_id]) }}" class="ml-1 btn btn-sm btn-primary">
            <i class="fas fa-eye"></i>
        </a>
        @foreach ($sale->client->phones as $phone)
        <a href="https://api.whatsapp.com/send?phone=54{{ $phone->formatted_number }}&text=Hola%2C%20{{ $sale->client->full_name }}%21&source=&data=&app_absent="
            class="ml-1 btn btn-sm btn-success" target="_blank">
            <i class="fab fa-whatsapp"></i>
        </a>
        @endforeach
        @if ($sale->client->address->has_location)
        <a href="{{ route('map.show', ['client' => $sale->client_id]) }}" class="ml-1 btn btn-sm btn-warning">
            <i class="fas fa-map-marker"></i>
        </a>
        @endif
    </div>
</div>

<div class="row">
    <div class="card col-lg-6 px-0 mb-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <ul class="nav nav-pills">
                @if($sale->nextPaymentToCollect)
                <li class="nav-item">
                    <button class="btn btn-link nav-link active" id="collectPaymentButton">
                        @if($sale->nextPaymentToCollect->previous_id)
                        Cobrar
                        @else
                        Entregar
                        @endif
                    </button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-link nav-link" id="postponePaymentButton">Posponer</button>
                </li>
                @else
                <button class="btn btn-link nav-link" id="postponePaymentButton" disabled>Cobrar</button>
                @endif
            </ul>
            @if($sale->nextPaymentToCollect)
            <span
                class="h4 mb-0 badge {{ $sale->nextPaymentToCollect->due_date < Carbon\Carbon::now() ? 'badge-danger' : 'badge-info' }}">
                {{ $sale->nextPaymentToCollect->due_date->diffForHumans() }}
            </span>
            @endif
        </div>
        <div class="card-body">
            @if($sale->nextPaymentToCollect)
            <form action="{{ route('collected', ['payment' => $sale->nextPaymentToCollect]) }}" method="POST"
                id="collectPaymentForm">
                @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Monto</label>
                        <input type="number" class="form-control" value="{{ $sale->nextPaymentToCollect->amount }}"
                            name="amount" @if(! $sale->nextPaymentToCollect->next)
                        max="{{ $sale->nextPaymentToCollect->amount }}" @endif>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="remaining">Saldo restante</label>
                        <input type="number" class="form-control" value="{{ $sale->nextPaymentToCollect->amount }}"
                            disabled>
                    </div>
                </div>

                @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="d-flex">
                    <button class="btn btn-primary ml-auto mr-0" type="submit">
                        @if($sale->nextPaymentToCollect->previous_id)
                        Registrar pago
                        @else
                        Registrar entrega
                        @endif
                    </button>
                </div>
            </form>

            <form action="{{ route('postponed', ['payment' => $sale->nextPaymentToCollect]) }}" method="POST"
                id="postponePaymentForm" class="d-none">
                @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label for="amount">Nuevo vencimiento</label>
                        <input type="date" class="form-control"
                            value="{{ $sale->nextPaymentToCollect->due_date->format('Y-m-d') }}" name="due_date"
                            min="{{ $sale->nextPaymentToCollect->due_date->format('Y-m-d') }}">
                    </div>
                </div>

                @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <div class="d-flex">
                    <button class="btn btn-primary ml-auto mr-0" type="submit">Posponer pago</button>
                </div>
            </form>
            @else
            <div class="h-100 d-flex flex-column justify-content-around align-items-center">
                Esta venta no tiene pagos pendientes.
            </div>
            @endif
        </div>
    </div>

    <div class="d-sm-none d-lg-block col-lg-1 mb-2"></div>

    <div class="col-lg-5 px-0 mb-2">
        <div class="card-header border d-flex">
            <h1 class="h6 m-0 font-weight-bold text-primary">Cuotas</h1>
        </div>

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
                    <p class="my-0"><strong>Vencimiento:</strong>
                        {{ $payment->formatted_due_date }}
                    </p>
                    <p class="my-0">
                        <strong>Monto:</strong>
                        ${{ number_format($payment->amount, 2, '.', ',') }}
                    </p>
                    @if($payment->paid_at)
                    <p class="my-0"><strong>Fecha de pago:</strong> {{ $payment->formatted_paid_at }}</p>
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

            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/views/payments/collect.js') }}"></script>
@endsection