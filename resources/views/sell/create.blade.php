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

        <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                    name="lastname" id="lastname" value="{{ old('lastname') }}">
                                @error('lastname')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" value="{{ old('name') }}">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dni">N° de documento</label>
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" name="dni"
                                    id="dni" value="{{ old('dni') }}">
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
                            <h1 class="h4 text-gray-800">
                                Teléfonos
                                <button id="addPhone" class="btn btn-sm btn-info">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </h1>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">#</th>
                                        <th>Característica</th>
                                        <th>Número</th>
                                        <th>Whatsapp</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody id="phonesContainer">
                                    <tr>
                                        <td>
                                            <input class="form-control order" value="1" type="text" disabled>
                                        </td>
                                        <td>
                                            <input value="{{ old('phones.0.area_code', '380') }}"
                                                class="form-control @error('phones.0.area_code') is-invalid @enderror"
                                                id="phones.0.area_code" name="phones[0][area_code]" type="text">
                                        </td>
                                        <td>
                                            <input value="{{ old('phones.0.number') }}"
                                                class="form-control @error('phones.0.number') is-invalid @enderror"
                                                id="phones.0.number" name="phones[0][number]" type="text">

                                        </td>
                                        <td>
                                            <div class="custom-control custom-switch h5">
                                                <input @if(old('phones.0.has_whatsapp')=='on' ) checked @endif
                                                    class="custom-control-input" id="phones.0.has_whatsapp"
                                                    name="phones[0][has_whatsapp]" type="checkbox">
                                                <label class="custom-control-label"
                                                    for="phones.0.has_whatsapp">Sí</label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger deleteRowButton" disabled>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                @if($errors->first('phones.0.area_code') OR $errors->first('phones.0.number'))
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="alert alert-danger">
                                                @error('phones.0.area_code')
                                                <li>
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                </li>
                                                @enderror
                                                @error('phones.0.number')
                                                <li>
                                                    <small class="text-danger">
                                                        {{ $message }}
                                                    </small>
                                                </li>
                                                @enderror
                                            </ul>
                                        </td>
                                    </tr>
                                </tfoot>
                                @endif
                            </table>
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
                                    <input type="text"
                                        class="form-control @error('address.neighborhood') is-invalid @enderror"
                                        id="address[neighborhood]" name="address[neighborhood]"
                                        value="{{ old('address.neighborhood') }}">
                                    @error('address.neighborhood')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-5 form-group">
                                    <label for="address[street]">Calle</label>
                                    <input type="text"
                                        class="form-control @error('address.street') is-invalid @enderror"
                                        id="address[street]" name="address[street]" value="{{ old('address.street') }}">
                                    @error('address.street')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="address[number]">
                                        Número
                                    </label>
                                    <input type="text"
                                        class="form-control @error('address.number') is-invalid @enderror"
                                        id="address[number]" name="address[number]" value="{{ old('address.number') }}">
                                    @error('address.number')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <small>Deja este campo en blanco si la casa no tiene numeración</small>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address[indications]">
                                        Indicaciones
                                        <small class="font-italic font-weight-light text-muted">
                                            (opcional) </small>
                                    </label>
                                    <textarea name="address[indications]" id="address[indications]" rows="2"
                                        class="form-control @error('address.indications') is-invalid @enderror">{{ old('address.indications') }}</textarea>
                                    @error('address.indications')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="address[details]">
                                        Detalles de la casa
                                        <small class="font-italic font-weight-light text-muted">
                                            (opcional) </small>
                                    </label>
                                    <textarea name="address[details]" id="address[details]" rows="2"
                                        class="form-control @error('address.details') is-invalid @enderror">{{ old('address.details') }}</textarea>
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
                                        <input type="file" name="house_photo"
                                            class="custom-file-input @error('house_photo') is-invalid @enderror"
                                            id="house_photo">
                                    </div>
                                    @error('house_photo')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col form-group">
                                    <label for="location">Ubicación de la casa</label><br>
                                    <div id="location w-100">
                                        <input type="hidden" name="address[lat]" id="latInput">
                                        <input type="hidden" name="address[lon]" id="lonInput">
                                        <button class="btn btn-info mb-1" id="btnLocation">Guardar ubicación
                                            (opcional)</button><br>
                                        <span id="locationFeedback"></span>
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
                                            <input type="radio" class="d-none products" name="product_id"
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
                                                    <input @if (old('is_reproduction')=='on' ) checked @endif
                                                        class="form-check-input @error('is_reproduction') is-invalid @enderror"
                                                        type="checkbox" id="is_reproduction" name="is_reproduction">
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
                                    <label for="deliver_date">Día de entrega</label>
                                    <input type="date" class="form-control @error('deliver_date') is-invalid @enderror"
                                        id="deliver_date" name="deliver_date"
                                        placeholder="Indicá qué fecha realizas la entrega"
                                        min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                                    @error('deliver_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <h1 class="h4 mt-5 text-gray-800">Pago</h1>
                            <div class="form-row mb-2">
                                <div class="col-12 col-md-8">
                                    <label for="quota_id">Cantidad de cuotas</label>
                                    <select class="custom-select @error('quota_id') is-invalid @enderror" id="quota_id"
                                        name="quota_id" disabled>
                                        <option></option>
                                    </select>
                                    @error('quota_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-4">
                                    <label for="quotaValidation">Total</label>
                                    <input class="form-control" id="total" disabled>
                                </div>

                                <div class="col-12">
                                    <label for="payment_description">Descripción
                                        <i><small>(OPCIONAL)</small></i></label>
                                    <input type="text"
                                        class="form-control @error('payment_description') is-invalid @enderror"
                                        id="payment_description" name="payment_description"
                                        placeholder="Ingresá información referida a los pagos">
                                </div>
                            </div>

                            <h1 class="h4 mt-5 text-gray-800">Días de cobro</h1>
                            <div class="form-row mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="dateValidation">Día aproximado de cobro</label>
                                    <input type="number" class="form-control @error('due_date') is-invalid @enderror"
                                        id="dateValidation" name="due_date"
                                        placeholder="Indicá, aproximadamente, qué día del mes tenés que pasar a cobrar"
                                        min="1" max="28">
                                    @error('due_date')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6">
                                    <label for="hourValidation">Hora aproximada <i><small>(OPCIONAL)</small></i></label>
                                    <input type="text" class="form-control @error('hour') is-invalid @enderror"
                                        id="hourValidation" name="hour"
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
<script>
    setBaseUrl("{{ env('APP_URL') }}");
</script>
@endsection