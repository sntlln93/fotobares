@extends('layouts.app')

@section('title', 'Entregas')

@section('styles')
<style>
    .card-max-width {
        margin-block: .8em;
    }
</style>
@endsection

@section('content')
<div class="input-group mb-2">
    <input type="text" class="form-control" id="searchInput">
    <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
</div>

<div class="row">
    @foreach ($payments as $payment)
    <div class="card col-md-6 col-lg-4 card-max-width p-0">
        <div class="card-header text-right">
            @foreach ($payment->phones as $phone)
            <a class="btn btn-sm btn-success ml-1" href="{{ route('whatsapp.send', ['phone' => $phone]) }}"
                target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            @endforeach
            @if ($payment->client->has_location)
            <a class="btn btn-sm btn-warning ml-1" href="{{ url('map/' . $payment->client->id) }}">
                <i class="fas fa-map-marker"></i>
            </a>
            @endif
            <a class="btn btn-sm btn-primary ml-1" href="{{ route('collect', ['sale' => $payment->sale_id]) }}">
                <i class="fas fa-dollar-sign"></i>
            </a>
        </div>
        <div class="card-body">
            <p class="mb-0">
                <b>Cliente:</b>
                <a href="{{ route('clients.show', ['client'=> $payment->client->id]) }}">{{
                    $payment->client->full_name }}</a>
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
                <b>Dirección:</b>
                {{ $payment->client->address }}
            </p>
        </div>

    </div>
    @endforeach
</div>

@endsection

@section('scripts')
@endsection