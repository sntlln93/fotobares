<div class="form-group">
    <label for="lastname">Apellido</label>
    <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="lastname"
        value="{{ old('lastname') }}">
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