<div class="form-row">
    <div class="w-100">
        <div class="form-group radio--select">
            <label for="product">Elegí un producto</label>

            <div class="form-group" style="gap: .5rem;" id="products">

            </div>
            @error('product_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group radio--select d-none" id="color-picker">
            <label for="product">Elegí un color</label>

            <div class="form-group d-flex" style="gap: .5rem;" id="colors">

            </div>
            @error('color')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Es reproducción</label>
            <div class="form-check">
                <input @if (old('is_reproduction')=='on' ) checked @endif
                    class="form-check-input @error('is_reproduction') is-invalid @enderror" type="checkbox"
                    id="is_reproduction" name="is_reproduction">
                <label class="form-check-label" for="is_reproduction">Sí</label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="description">Descripción de la foto que irá en el
                    mural <small>(opcional)</small></label>
                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description"
                    id="description" value="{{ old('description') }}">
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="code">Código <small>(opcional)</small></label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code"
                    value="{{ old('code') }}">
                @error('code')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>
</div>