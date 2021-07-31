@extends('layouts.app')

@section('title', 'Modificar teléfono de {{ $phone->phoneable->full_name }}')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar teléfono de {{ $phone->phoneable->full_name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('phones.update', ['phone' => $phone->id]) }}" method="POST"
            class="col-sm-12 col-md-8 offset-md-2">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="area_code">Característica</label>
                <input type="text" name="area_code" id="area_code"
                    class="form-control @error('area_code') is-invalid @enderror"
                    value="{{ old('area_code', $phone->area_code) }}">
                @error('area_code') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="number">Número</label>
                <input type="text" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
                    value="{{ old('number', $phone->number) }}">
                @error('number') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>¿Tiene Whatsapp?</label>
                <div class="custom-control custom-switch">
                    <input @if(old('has_whatsapp', $phone->has_whatsapp)) checked @endif class="custom-control-input"
                    id="has_whatsapp"
                    name="has_whatsapp" type="checkbox" value="1">
                    <label class="custom-control-label" for="has_whatsapp">Sí</label>
                </div>
            </div>


            <button class="btn btn-primary" type="submit">Guardar cambios</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/products/create.js') }}"></script>
@endsection