@extends('layouts.app')

@section('title', 'Modificar datos de {{ $client->full_name }}')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar datos de {{ $client->full_name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="POST"
            class="col-sm-12 col-md-8 offset-md-2">
            @csrf @method('PUT')

            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="text" name="lastname" id="lastname"
                    class="form-control @error('lastname') is-invalid @enderror"
                    value="{{ old('lastname', $client->lastname) }}">
                @error('lastname') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $client->name) }}">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="dni">Número de documento</label>
                <input type="number" name="dni" id="dni" class="form-control @error('dni') is-invalid @enderror"
                    value="{{ old('dni', $client->dni) }}">
                @error('dni') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button class="btn btn-primary" type="submit">Guardar cambios</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/products/create.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
@endsection