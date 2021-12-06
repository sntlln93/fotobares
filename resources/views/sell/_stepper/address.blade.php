<div class="form-row">
    <div class="col-md-5 form-group">
        <label for="address[neighborhood]">Barrio</label>
        <input type="text" class="form-control @error('address.neighborhood') is-invalid @enderror"
            id="address[neighborhood]" name="address[neighborhood]" value="{{ old('address.neighborhood') }}">
        @error('address.neighborhood')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-5 form-group">
        <label for="address[street]">Calle</label>
        <input type="text" class="form-control @error('address.street') is-invalid @enderror" id="address[street]"
            name="address[street]" value="{{ old('address.street') }}">
        @error('address.street')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="col-md-2 form-group">
        <label for="address[number]">
            Número
        </label>
        <input type="number" class="form-control @error('address.number') is-invalid @enderror" id="address[number]"
            name="address[number]" value="{{ old('address.number') }}">
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
            <input type="file" class="custom-file-input @error('house_photo') is-invalid @enderror" id="house_photo"
                accept="image/jpeg, jpg" capture="camera">
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