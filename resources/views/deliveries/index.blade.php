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
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                data-target="#photo{{ $sale->id }}"><i class="fas fa-image"></i></button>
            <a class="btn btn-sm btn-warning" href="{{ url('map/' . $sale->client_id) }}">
                <i class="fas fa-map-marker"></i>
            </a>
            @foreach ($sale->client->phones as $phone)
            <a class="btn btn-sm btn-success" href="{{ route('whatsapp.send', ['phone' => $phone]) }}" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="tel:{{ $phone->full_number }}" class="btn btn-sm btn-primary"><i class="fas fa-phone"></i></a>
            @endforeach
            <a href="{{ route('recalculate.form', ['sale' => $sale->id]) }}" class="btn btn-sm btn-dark"><i
                    class="fas fa-credit-card"></i></a>
            <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="text-uppercase btn btn-sm btn-info"><i
                    class="fas fa-eye"></i> Ver</a>
        </div>

        <div class="modal fade" id="photo{{$sale->id}}" tabindex="-1" aria-labelledby="photo{{$sale->id}}Label"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="photo{{$sale->id}}Label">Fotos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($sale->details as $detail)
                        <img src="{{ asset('storage/'.$detail->photo?->path) }}" alt="" class="img-fluid">
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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
                @include('_partials.detail')
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