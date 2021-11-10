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
    @foreach ($sales as $sale)
    <div class="card col-md-6 col-lg-4 card-max-width p-0">
        <div class="card-header text-right">
            <a class="btn btn-sm btn-warning" href="{{ url('map/' . $sale->client_id) }}">
                <i class="fas fa-map-marker"></i>
            </a>
            @foreach ($sale->client->phones as $phone)
            <a class="btn btn-sm btn-success" href="{{ route('whatsapp.send', ['phone' => $phone]) }}" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="tel:{{ $phone->full_number }}" class="btn btn-sm btn-primary"><i class="fas fa-phone"></i></a>
            @endforeach
            <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="text-uppercase btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> Ver</a>
        </div>
        <div class="card-body">
            <p class="mb-0">
                <b>Cliente:</b>
                <a href="{{ route('clients.show', ['client' => $sale->client_id]) }}">{{
                    $sale->client->full_name }}</a>
            </p>
            <p class="mb-0">
                <b>Producto:</b>
                @foreach ($sale->details as $detail)
                <span class="badge text-white text-wrap text-left {{ $detail->color }}">{{
                    $detail->product->name
                    }}
                    {{ $detail->description ? '('.$detail->description.')' : '(-)'}}</span>
                @endforeach
            </p>
            <p class="mb-0">
                <b>Vendedor:</b>
                {{ $sale->seller->full_name }}
            </p>
            <p class="mb-0">
                <b>Dirección:</b>
                <span>
                    {{ $sale->client->address->formatted_address }}
                    <a class="btn btn-sm btn-warning ml-1" href="{{ url('map/' . $sale->client_id) }}">
                        <i class="fas fa-map-marker"></i>
                    </a>
                </span>
            </p>
            <p class="mb-2">
                <b>Fecha de entrega:</b>
                {{ $sale->deliver_on->isoFormat('D [de] MMMM Y') }}
            </p>
            <a class="w-100 btn btn-primary" href="{{ route('collect', ['sale' => $sale->id]) }}">Entregar</a>
        </div>
    </div>
    @endforeach
</div>

@endsection

@section('scripts')
@endsection