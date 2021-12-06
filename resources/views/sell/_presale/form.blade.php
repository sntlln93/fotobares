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
            <input value="{{ old('number') }}" class="form-control @error('number') is-invalid @enderror" name="number"
                type="number">
            @error('number')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group col-md-3">
            <label>¿Tiene whatsapp?</label>
            <div class="custom-control custom-switch h5">
                <input @if(old('has_whatsapp')=='on' ) checked @endif class="custom-control-input" name="has_whatsapp"
                    id="has_whatsapp" type="checkbox">
                <label class="custom-control-label" for="has_whatsapp"></label>
            </div>
            @error('has_whatsapp')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group col-md-6">
            <label for="address_street">Calle <small><em>(OPCIONAL)</em></small></label>
            <input type="text" name="address_street" class="form-control @error('address_street') is-invalid @enderror"
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