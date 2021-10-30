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
    <div class="overflow-hidden">
        <div class="bs-stepper-header justify-content-between mb-2" role="tablist">
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
                <h1 class="h4 text-gray-800">Datos del cliente</h1>

                <div class="form-group">
                    <label for="lastname">Apellido</label>
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                        id="lastname" value="{{ old('lastname') }}">
                    @error('lastname')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                        value="{{ old('name') }}">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="dni">N° de documento</label>
                    <input type="number" class="form-control @error('dni') is-invalid @enderror" name="dni" id="dni"
                        value="{{ old('dni') }}">
                    @error('dni')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div id="phone-part" class="content" role="tabpanel" aria-labelledby="phone-part-trigger">
                <h1 class="h4 text-gray-800">
                    Teléfonos
                    <button id="addPhone" class="btn btn-sm btn-info">
                        <i class="fas fa-plus"></i>
                    </button>
                </h1>
                <div class="pt-4 pb-2 pl-2 table-responsive">
                    <table class="table table-bordered mx-0">
                        <thead>
                            <tr>
                                <th class="text-center">Característica</th>
                                <th class="text-center text-nowrap">Número sin característica</th>
                                <th class="text-center"><i class="fab fa-whatsapp"></i></th>
                                <th class="text-center"><i class="fas fa-trash"></i></th>
                            </tr>
                        </thead>
                        <tbody id="phonesContainer">
                            <tr>
                                <td>
                                    <input value="{{ old('phones.0.area_code', '380') }}"
                                        class="form-control @error('phones.0.area_code') is-invalid @enderror"
                                        id="phones.0.area_code" name="phones[0][area_code]" type="number">
                                </td>
                                <td>
                                    <input value="{{ old('phones.0.number') }}"
                                        class="form-control w-100 @error('phones.0.number') is-invalid @enderror"
                                        id="phones.0.number" name="phones[0][number]" type="number">

                                </td>
                                <td>
                                    <div class="custom-control custom-switch h5">
                                        <input @if(old('phones.0.has_whatsapp')=='on' ) checked @endif
                                            class="custom-control-input" id="phones.0.has_whatsapp"
                                            name="phones[0][has_whatsapp]" type="checkbox">
                                        <label class="custom-control-label" for="phones.0.has_whatsapp"></label>
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

            <div id="address-part" class="content" role="tabpanel" aria-labelledby="address-part-trigger">
                <h1 class="h4 text-gray-800">Dirección</h1>
                <div class="form-row">
                    <div class="col-md-5 form-group">
                        <label for="address[neighborhood]">Barrio</label>
                        <input type="text" class="form-control @error('address.neighborhood') is-invalid @enderror"
                            id="address[neighborhood]" name="address[neighborhood]"
                            value="{{ old('address.neighborhood') }}">
                        @error('address.neighborhood')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-5 form-group">
                        <label for="address[address_street]">Calle</label>
                        <input type="text" class="form-control @error('address.address_street') is-invalid @enderror"
                            id="address[address_street]" name="address[address_street]"
                            value="{{ old('address.address_street') }}">
                        @error('address.address_street')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-2 form-group">
                        <label for="address[number]">
                            Número
                        </label>
                        <input type="number" class="form-control @error('address.number') is-invalid @enderror"
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
                            <label class="custom-file-label" for="photo">
                                0 fotos seleccionadas
                            </label>
                            <input type="file" class="custom-file-input @error('house_photo') is-invalid @enderror"
                                id="house_photo" accept="image/jpeg, jpg" capture="camera">
                        </div>
                        <img src="" alt="" class="img-fluid">
                        <input type="hidden" name="house_photo" value="">
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

            <div id="product-part" class="content" role="tabpanel" aria-labelledby="product-part-trigger">
                <h1 class="h4 text-gray-800">Producto</h1>
                <div class="form-row">
                    <div class="w-100">
                        <div class="form-group radio--select">
                            <label for="product">Elegí un producto</label>

                            <div class="form-group">
                                @foreach ($products as $product)
                                <input type="radio" class="d-none products" name="product_id"
                                    id="product.{{ $product->id }}" value="{{ $product->id }}"
                                    @if(old('product_id')==$product->id) checked @endif>
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
                                    <input type="radio" class="d-none" name="color" id="1" value="AZUL"
                                        @if(old('color')=="AZUL" ) checked @endif>
                                    <label for="1" class="text-white radio--container"
                                        style="background-color: #396adb">
                                        <span class="radio--title">AZUL</span>
                                    </label>

                                    <input type="radio" class="d-none" name="color" id="2" value="NEGRO"
                                        @if(old('color')=="NEGRO" ) checked @endif>
                                    <label for="2" class="text-white radio--container"
                                        style="background-color: #2a2a2b">
                                        <span class="radio--title">NEGRO</span>
                                    </label>

                                    <input type="radio" class="d-none" name="color" id="3" value="ROSADO"
                                        @if(old('color')=="ROSADO" ) checked @endif>
                                    <label for="3" class="text-white radio--container"
                                        style="background-color: #e069e0">
                                        <span class="radio--title">ROSADO</span>
                                    </label>

                                    <input type="radio" class="d-none" name="color" id="4" value="BLANCO"
                                        @if(old('color')=="BLANCO" ) checked @endif>
                                    <label for="4" class="text-white radio--container"
                                        style="background-color: #fafafa">
                                        <span class="radio--title" style="color: #363636">BLANCO</span>
                                    </label>

                                    @error('color')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Es reproducción</label>
                                <div class="form-check">
                                    <input @if (old('is_reproduction')=='on' ) checked @endif
                                        class="form-check-input @error('is_reproduction') is-invalid @enderror"
                                        type="checkbox" id="is_reproduction" name="is_reproduction">
                                    <label class="form-check-label" for="is_reproduction">Sí</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Descripción de la foto que irá en el
                                    mural <small>(opcional)</small></label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="description" value="{{ old('description') }}">
                                @error('description')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="payment-part" class="content" role="tabpanel" aria-labelledby="payment-part-trigger">
                <h1 class="h4 text-gray-800">Pago</h1>
                <div class="form-row mb-2">
                    <div class="col-12 col-md-8">
                        <label for="quota_id">Cantidad de cuotas</label>
                        <select class="custom-select @error('quota_id') is-invalid @enderror" id="quota_id"
                            name="quota_id" @if(! old('product_id')) disabled @endif>
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
                            <small>(opcional)</small></label>
                        <input type="text" class="form-control @error('payment_description') is-invalid @enderror"
                            id="payment_description" name="payment_description"
                            placeholder="Ingresá información referida a los pagos"
                            value="{{ old('payment_description') }}">
                    </div>
                </div>

                <h1 class="h4 mt-5 text-gray-800">Fechas</h1>
                <div class="form-row mb-2">
                    <div class="col-12 col-md-6">
                        <label for="deliver_date">Día de entrega</label>
                        <input type="date" class="form-control @error('deliver_date') is-invalid @enderror"
                            id="deliver_date" name="deliver_date" placeholder="Indicá qué fecha realizas la entrega"
                            min="{{ Carbon\Carbon::tomorrow()->format('Y-m-d') }}" value="{{ old('deliver_date') }}">
                        @error('deliver_date')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label for="hourValidation">Hora aproximada <small>(opcional)</small></label>
                        <input type="text" class="form-control @error('hour') is-invalid @enderror" id="hourValidation"
                            name="hour" placeholder="La hora a la que más probablemente encuentres a tu cliente en casa"
                            value="{{ old('hour') }}">
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
    <form action="{{ route('presale.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="lastname">Apellido</label>
                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                    value="{{ old('lastname') }}">
                @error('lastname')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="name">Nombre</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="area_code">Característica</label>
                <input value="{{ old('area_code', '380') }}"
                    class="form-control w-100 @error('area_code') is-invalid @enderror" name="area_code" type="number">
                @error('area_code')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-5">
                <label for="number">Número</label>
                <input value="{{ old('number') }}" class="form-control @error('number') is-invalid @enderror"
                    name="number" type="number">
                @error('number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-3">
                <label>¿Tiene whatsapp?</label>
                <div class="custom-control custom-switch h5">
                    <input @if(old('has_whatsapp')=='on' ) checked @endif class="custom-control-input"
                        name="has_whatsapp" id="has_whatsapp" type="checkbox">
                    <label class="custom-control-label" for="has_whatsapp"></label>
                </div>
                @error('has_whatsapp')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="address_street">Calle <small><em>(OPCIONAL)</em></small></label>
                <input type="text" name="address_street"
                    class="form-control @error('address_street') is-invalid @enderror"
                    value="{{ old('address_street') }}">
                @error('address_street')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="address_neighborhood">Barrio <small><em>(OPCIONAL)</em></small></label>
                <input type="text" name="address_neighborhood"
                    class="form-control @error('address_neighborhood') is-invalid @enderror"
                    value="{{ old('address_neighborhood') }}">
                @error('address_neighborhood')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="address_number">Número de casa <small><em>(OPCIONAL)</em></small></label>
                <input type="number" min="0" name="address_number"
                    class="form-control @error('address_number') is-invalid @enderror" value="{{ old('number') }}">
                @error('address_number')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-sm-6">
                <label for="contact_date">Llamar el día <small><em>(OPCIONAL)</em></small></label>
                <input type="date" name="contact_date" class="form-control @error('contact_date') is-invalid @enderror"
                    value="{{ old('contact_date') }}">
                @error('contact_date')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group col-sm-12">
                <label for="information">Información adicional</label>
                <textarea name="information" rows="2"
                    class="form-control @error('information') is-invalid @enderror">{{ old('information') }}</textarea>
                @error('information')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar datos</button>

        </div>
    </form>
</div>

@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/utils/bs-stepper.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/views/sell/create.css') }}">
@endsection

@section('scripts')
@if(old('quota_id'))
<script>
    const quotaId = {{ old('quota_id') }};
</script>
@endif
<script src="{{ asset('js/utils/bs-stepper.min.js') }}"></script>
<script src="{{ asset('js/views/sell/create.js') }}"></script>
<script>
    setBaseUrl("{{ env('APP_URL') }}");
</script>
@endsection