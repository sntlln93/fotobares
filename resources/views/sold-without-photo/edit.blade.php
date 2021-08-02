@extends('layouts.app')

@section('title', 'Agregar foto')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Agregar foto</h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('without-photo.update', ['detail' => $detail]) }}"
            class="col-sm-12 col-md-8 offset-md-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group col-sm-12">
                    <label for="">Elija una foto para este mural [{{ $detail->product->name }} -
                        {{ $detail->color }}]</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="photo" name="photo">
                        <label class="custom-file-label" for="photo">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div id="photo-preview" class="form-group col-sm-12 offset-md-3 col-md-6">

                </div>
            </div>

            <div class="form-group">
                <label for="description">Descripción de la foto que irá en el
                    mural <small>(opcional)</small></label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" value="{{ old('description', $detail->description) }}">
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Agregar foto</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/sold-without-photo/edit.js') }}"></script>
@endsection