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
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{ old('name') }}">
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
                                                name="phones[0][has_whatsapp]" @if (old('phones.0.has_whatsapp') == 'on') checked @endif>
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
                                        <label for="address_neiborhood">Barrio</label>
                                        <input type="text" class="form-control" id="address_neiborhood"
                                            name="address_neiborhood" value="{{ old('address_neiborhood') }}">
                                        @error('address_neiborhood')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-5 form-group">
                                        <label for="address_street">Calle</label>
                                        <input type="text" class="form-control" id="address_street" name="address_street"
                                            value="{{ old('address_street') }}">
                                        @error('address_street')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-2 form-group">
                                        <label for="address_number">Número</label>
                                        <input type="text" class="form-control" id="address_number" name="address_number"
                                            value="{{ old('address_number') }}">
                                        @error('address_number')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="address_indications">Indicaciones</label>
                                        <textarea name="address_indications" id="address_indications" rows="2"
                                            class="form-control">{{ old('address_indications') }}</textarea>
                                        @error('address_indications')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label for="address_details">Detalles de la casa</label>
                                        <textarea name="address_details" id="address_details" rows="2"
                                            class="form-control">{{ old('address_details') }}</textarea>
                                        @error('address_details')
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
                                        <label for="address_location">Detalles de la casa</label><br>
                                        <input type="hidden" name="address_lat">
                                        <input type="hidden" name="address_lon">
                                        <button class="btn btn-info">Guardar ubicación (opcional)</button>
                                        @error('address_location')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
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
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" id="has_whatsapp.0"
                                                            name="phones[0][has_whatsapp]" @if (old('phones.0.has_whatsapp') == 'on') checked @endif>
                                                        <label class="form-check-label" for="has_whatsapp.0">Es
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
                                        <input type="number" class="form-control" id="delivery" name="delivery"
                                            placeholder="Colocá cuánto se abona para la entrega" required>
                                        <div class="invalid-feedback">
                                            Debes indicar cuánto cobrás por entregar el producto
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="deliver_date">Día de entrega</label>
                                        <input type="date" class="form-control" id="deliver_date" name="deliver_date"
                                            placeholder="Indicá qué fecha realizas la entrega" required>
                                        <div class="invalid-feedback">
                                            Debes indicar un día para entregar
                                        </div>
                                    </div>
                                </div>

                                <h1 class="h4 mt-5 text-gray-800">Pago</h1>
                                <div class="form-row mb-2">
                                    <div class="col-12 col-md-6">
                                        <label for="methodValidation">Forma de pago</label>
                                        <select class="custom-select" name="method_id" id="methodValidation" required>
                                            <option>Por favor elegí un método de pago</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Mercado Pago</option>
                                            <option value="3">Posnet</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Debes elegir un método de pago
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <label for="quotaValidation">Cantidad de cuotas</label>
                                        <input type="number" class="form-control" id="quotaValidation" name="quotas"
                                            placeholder="Colocá la cantidad de pagos" min="1" required>
                                        <div class="invalid-feedback">
                                            Debes indicar en cuántos pagos se va a hacer
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row mb-2">
                                    <div class="col-sm-12">
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
                                            required>
                                        <div class="invalid-feedback">
                                            Debes indicar un día
                                        </div>
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
