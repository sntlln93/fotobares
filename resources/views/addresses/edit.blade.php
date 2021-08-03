@extends('layouts.app')

@section('title', 'Modificar dirección de {{ $address->client->full_name }}')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar dirección de {{ $address->client->full_name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('addresses.update', ['address' => $address->id]) }}" method="POST"
            class="col-sm-12 col-md-8 offset-md-2" enctype="multipart/form-data">
            @csrf @method('PUT')
            @if($errors->any())
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
            @endif
            <div class="form-row">
                <div class="col-md-5 form-group">
                    <label for="neighborhood">Barrio</label>
                    <input type="text" class="form-control @error('neighborhood') is-invalid @enderror"
                        id="neighborhood" name="neighborhood" value="{{ old('neighborhood', $address->neighborhood) }}">
                    @error('neighborhood')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-5 form-group">
                    <label for="street">Calle</label>
                    <input type="text" class="form-control @error('street') is-invalid @enderror" id="street"
                        name="street" value="{{ old('street', $address->street) }}">
                    @error('street')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-2 form-group">
                    <label for="number">
                        Número
                    </label>
                    <input type="number" class="form-control @error('number') is-invalid @enderror" id="number"
                        name="number" value="{{ old('number', $address->number) }}">
                    @error('number')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small>Deja este campo en blanco si la casa no tiene numeración</small>
                </div>

                <div class="col-md-6 form-group">
                    <label for="indications">
                        Indicaciones
                        <small class="font-italic font-weight-light text-muted">
                            (opcional) </small>
                    </label>
                    <textarea name="indications" id="indications" rows="2"
                        class="form-control @error('indications') is-invalid @enderror">{{ old('indications', $address->indications) }}</textarea>
                    @error('indications')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="details">
                        Detalles de la casa
                        <small class="font-italic font-weight-light text-muted">
                            (opcional) </small>
                    </label>
                    <textarea name="details" id="details" rows="2"
                        class="form-control @error('details') is-invalid @enderror">{{ old('details', $address->details) }}</textarea>
                    @error('details')
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
                        <input type="file" name="house_photo"
                            class="custom-file-input @error('house_photo') is-invalid @enderror" id="house_photo"
                            accept="image/jpeg, jpg" capture="camera">
                    </div>
                    @error('house_photo')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col form-group">
                    <label for="location">Ubicación de la casa</label><br>
                    <div id="location w-100">
                        <input type="hidden" name="lat" id="latInput" value="{{ old('lat', $address->lat) }}">
                        <input type="hidden" name="lon" id="lonInput" value="{{ old('lon', $address->lon) }}">
                        <button class="btn btn-info mb-1" id="btnLocation">
                            @if(old('lat') || old('lon') || $address->has_location)
                            Actualizar ubicación
                            @else
                            Guardar ubicación
                            @endif
                            (opcional)
                        </button><br>
                        <span id="locationFeedback">
                            @if(old('lat') || old('lon') || $address->has_location)
                            Existe una ubicación guardada.
                            <i class="fas fa-check-circle"></i>
                            @endif
                        </span>
                    </div>
                </div>
            </div>


            <button class="btn btn-primary" type="submit">Guardar cambios</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/addresses/edit.js') }}"></script>
@endsection