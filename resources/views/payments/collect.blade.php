@extends('layouts.app')

@section('title', 'Cobrar')

@section('content')

<div class="row">
    <div class="card col-lg-6 px-0 mb-2">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h4 mb-0 text-gray-800">Cobrar</h1>
            @if($sale->nextPaymentToCollect)
            <span
                class="h4 mb-0 badge {{ $sale->nextPaymentToCollect->due_date < Carbon\Carbon::now() ? 'badge-danger' : 'badge-info' }}">
                Vencimiento
                {{ $sale->nextPaymentToCollect->due_date->diffForHumans() }}
            </span>
            @endif
        </div>
        <div class="card-body">
            @if($sale->nextPaymentToCollect)
            <form action="{{ route('collected', ['payment' => $sale->nextPaymentToCollect]) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="amount">Monto</label>
                        <input type="number" class="form-control" value="{{ $sale->nextPaymentToCollect->amount }}"
                            name="amount">
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
                    <button class="btn btn-primary ml-auto mr-0" type="submit">Registrar pago</button>
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

    <div class="card col-lg-5 px-0 mb-2">
        <div class="card-header d-flex">
            <h1 class="h4 mb-0 text-gray-800">Cuotas de {{ $sale->client->full_name }}</h1>

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

        <div class="card-body">
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
                            {{ $payment->due_date->isoFormat('D [de] MMMM Y') }}
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

                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection