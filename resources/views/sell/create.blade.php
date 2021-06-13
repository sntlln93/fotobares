@extends('layouts.app')

@section('title', 'Nueva venta')

@section('content')

<div class="container">

    <div class="bs-stepper">
        <div class="overflow-hidden">
            <div class="bs-stepper-header justify-content-between" role="tablist">
                <!-- your steps here -->
                <div class="step" data-target="#client-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="client-part"
                        id="client-part-trigger">
                        <span class="bs-stepper-circle">1</span>
                    </button>
                </div>

                <div class="step" data-target="#phone-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="phone-part"
                        id="phone-part-trigger">
                        <span class="bs-stepper-circle">2</span>
                    </button>
                </div>

                <div class="step" data-target="#address-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="address-part"
                        id="address-part-trigger">
                        <span class="bs-stepper-circle">3</span>
                    </button>
                </div>

                <div class="step" data-target="#product-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="product-part"
                        id="product-part-trigger">
                        <span class="bs-stepper-circle">4</span>
                    </button>
                </div>

                <div class="step" data-target="#payment-part">
                    <button type="button" class="step-trigger" role="tab" aria-controls="payment-part"
                        id="payment-part-trigger">
                        <span class="bs-stepper-circle">5</span>
                    </button>
                </div>
            </div>
        </div>

        <form action="{{ route('sales.store') }}" method="POST">
            @csrf
            <div class="bs-stepper-content">
                <div id="client-part" class="content" role="tabpanel" aria-labelledby="client-part-trigger">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 text-gray-800">Datos del cliente</h1>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="lastname">Apellido</label>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                    value="{{ old('lastname') }}">
                                @error('lastname')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dni">N° de documento</label>
                                <input type="text" class="form-control" name="dni" id="dni" value="{{ old('dni') }}">
                                @error('dni')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div id="phone-part" class="content" role="tabpanel" aria-labelledby="phone-part-trigger">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 text-gray-800">Teléfonos</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="area_code.0">Característica</label>
                                    <input type="text" class="form-control" id="area_code.0" name="phones[0][area_code]"
                                        value="{{ old('phones.0.area_code') }}">
                                    @error('phones.0.area_code')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="number.0">Número</label>
                                    <input type="text" class="form-control" id="number.0" name="phones[0][number]"
                                        value="{{ old('phones.0.number') }}">
                                    @error('phones.0.number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="has_whatsapp.0"
                                            name="phones[0][has_whatsapp]" @if (old('phones.0.has_whatsapp')=='on' )
                                            checked @endif>
                                        <label class="form-check-label" for="has_whatsapp.0">Whatsapp</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="address-part" class="content" role="tabpanel" aria-labelledby="address-part-trigger">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 text-gray-800">Dirección</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-5 form-group">
                                    <label for="address[neighborhood]">Barrio</label>
                                    <input type="text" class="form-control" id="address[neighborhood]"
                                        name="address[neighborhood]" value="{{ old('address.neighborhood') }}">
                                    @error('address.neighborhood')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-5 form-group">
                                    <label for="address[street]">Calle</label>
                                    <input type="text" class="form-control" id="address[street]" name="address[street]"
                                        value="{{ old('address.street') }}">
                                    @error('address.street')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="address[number]">Número</label>
                                    <input type="text" class="form-control" id="address[number]" name="address[number]"
                                        value="{{ old('address.number') }}">
                                    @error('address.number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address[indications]">Indicaciones</label>
                                    <textarea name="address[indications]" id="address[indications]" rows="2"
                                        class="form-control">{{ old('address.indications') }}</textarea>
                                    @error('address.indications')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address[details]">Detalles de la casa</label>
                                    <textarea name="address[details]" id="address[details]" rows="2"
                                        class="form-control">{{ old('address.details') }}</textarea>
                                    @error('address.details')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="house_photo">
                                        Foto de la casa
                                        <small class="font-italic font-weight-light text-muted">
                                            (opcional) </small>
                                    </label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="house_photo">
                                            0 fotos seleccionadas
                                        </label>
                                        <input type="file" name="house_photo" class="custom-file-input"
                                            id="house_photo">
                                    </div>
                                    @error('house_photo')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="location">Detalles de la casa</label><br>
                                    <div id="location">
                                        <input type="hidden" name="address[lat]" id="latInput">
                                        <input type="hidden" name="address[lon]" id="lonInput">
                                        <button class="btn btn-info" id="btnLocation">Guardar ubicación
                                            (opcional)</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="product-part" class="content" role="tabpanel" aria-labelledby="product-part-trigger">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 text-gray-800">Producto</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="w-100">
                                    <div class="form-group radio--select">
                                        <label for="product">Elegí un producto</label>

                                        <div class="form-group">
                                            @foreach ($products as $product)
                                            <input type="radio" class="d-none" name="product_id"
                                                id="product.{{ $product->id }}" value="{{ $product->id }}">
                                            <label for="product.{{ $product->id }}" class="radio--container">
                                                <p class="my-1 radio--title">
                                                    <strong>{{ $product->name }}</strong>
                                                </p>
                                                <p class="my-1 radio--info">
                                                    ${{ number_format($product->price, 2, ',', '.') }}</p>
                                            </label>
                                            @endforeach

                                            @error('product_id')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group radio--select">
                                            <label for="product">Elegí un color</label>

                                            <div class="form-group">
                                                <input type="radio" class="d-none" name="color" id="1" value="AZUL">
                                                <label for="1" class="text-white radio--container"
                                                    style="background-color: #396adb">
                                                    <span class="radio--title">AZUL</span>
                                                </label>

                                                <input type="radio" class="d-none" name="color" id="2" value="NEGRO">
                                                <label for="2" class="text-white radio--container"
                                                    style="background-color: #2a2a2b">
                                                    <span class="radio--title">NEGRO</span>
                                                </label>

                                                <input type="radio" class="d-none" name="color" id="3" value="VIOLETA">
                                                <label for="3" class="text-white radio--container"
                                                    style="background-color: #8e4fab">
                                                    <span class="radio--title">VIOLETA</span>
                                                </label>

                                                @error('color')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="checkbox" id="is_reproduction"
                                                        name="is_reproduction" @if (old('is_reproduction')=='on' )
                                                        checked @endif>
                                                    <label class="form-check-label" for="is_reproduction">Es
                                                        reproducción</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h4 text-gray-800">Pago</h1>
                        </div>
                        <div class="card-body">
                            <h1 class="h4 text-gray-800">Entrega</h1>
                            <div class="form-row mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="delivery">Monto de la entrega</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="number" class="form-control" id="delivery" name="delivery"
                                            placeholder="Colocá cuánto se abona para la entrega">
                                    </div>
                                    @error('delivery')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="deliver_date">Día de entrega</label>
                                    <input type="date" class="form-control" id="deliver_date" name="deliver_date"
                                        placeholder="Indicá qué fecha realizas la entrega"
                                        min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                    @error('deliver_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <h1 class="h4 mt-5 text-gray-800">Pago</h1>
                            <div class="form-row mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="quotaValidation">Cantidad de cuotas</label>
                                    <input type="number" class="form-control" id="quotaValidation" name="quotas"
                                        placeholder="Colocá la cantidad de pagos" min="1">
                                    @error('quotas')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="payment_description">Descripción
                                        <i><small>(OPCIONAL)</small></i></label>
                                    <input type="text" class="form-control" id="payment_description"
                                        name="payment_description"
                                        placeholder="Ingresá información referida a los pagos">
                                </div>
                            </div>

                            <h1 class="h4 mt-5 text-gray-800">Días de cobro</h1>
                            <div class="form-row mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="dateValidation">Día aproximado de cobro</label>
                                    <input type="number" class="form-control" id="dateValidation" name="due_date"
                                        placeholder="Indicá, aproximadamente, qué día del mes tenés que pasar a cobrar"
                                        min="1" max="28">
                                    @error('due_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="hourValidation">Hora aproximada <i><small>(OPCIONAL)</small></i></label>
                                    <input type="text" class="form-control" id="hourValidation" name="hour"
                                        placeholder="La hora a la que más probablemente encuentres a tu cliente en casa">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <button class="btn btn-secondary" id="prev-step">Anterior</button>
                    <button class="btn btn-primary" id="next-step">Siguiente</button>
                    <button class="btn btn-primary d-none" id="submit">Registrar venta</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/utils/bs-stepper.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/views/sell/create.css') }}">
@endsection

@section('scripts')
<script src="{{ asset('js/utils/bs-stepper.min.js') }}"></script>
<script src="{{ asset('js/views/sell/create.js') }}"></script>
@endsection