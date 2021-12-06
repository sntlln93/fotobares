@extends('layouts.app')

@section('title', 'Nueva venta')

@section('content')

<ul class="nav nav-pills">
    <li class="nav-item">
        <button id="sellBtn" class="btn btn-link nav-link active">Vender</button>
    </li>
    <li class="nav-item">
        <button id="toConfirmSaleBtn" class="btn btn-link nav-link">Guardar datos</button>
    </li>
</ul>
<div id="sellForm" class="bs-stepper">
    @include('sell._stepper.header')

    <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="bs-stepper-content">
            <div id="client-part" class="content" role="tabpanel" aria-labelledby="client-part-trigger">
                <h1 class="h4 text-gray-800">Datos del cliente</h1>
                @include('sell._stepper.client')
            </div>

            <div id="phone-part" class="content" role="tabpanel" aria-labelledby="phone-part-trigger">
                @include('sell._stepper.phone')
            </div>

            <div id="address-part" class="content" role="tabpanel" aria-labelledby="address-part-trigger">
                <h1 class="h4 text-gray-800">Dirección</h1>
                @include('sell._stepper.address')
            </div>

            <div id="product-part" class="content" role="tabpanel" aria-labelledby="product-part-trigger">
                <h1 class="h4 text-gray-800">Producto</h1>
                @include('sell._stepper.product')
            </div>

            <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                <h1 class="h4 text-gray-800">Pago</h1>
                @include('sell._stepper.payment')
            </div>

            <div class="d-flex justify-content-between mt-2">
                <button class="btn btn-secondary" id="prev-step">Anterior</button>
                <button class="btn btn-primary" id="next-step">Siguiente</button>
                <button class="btn btn-primary d-none" id="submit">Registrar venta</button>
            </div>
        </div>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div id="toConfirmSaleForm" class="d-none">
    @include('sell._presale.form')
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/utils/bs-stepper.min.css') }}?ts={{ env('APP_ASSET_VERSIONING') }}">
<link rel="stylesheet" href="{{ asset('css/views/sell/create.css') }}?ts={{ env('APP_ASSET_VERSIONING') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/utils/bs-stepper.min.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
<script>
    const products = @json($products);
    const oldInput = @json(old());
</script>
<script src="{{ asset('js/views/sell/create.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
@endsection