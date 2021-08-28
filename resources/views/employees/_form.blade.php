@csrf
<div class="form-group">
    <label for="lastname">Apellido</label>
    <input type="text" name="lastname" id="lastname" class="form-control @error('lastname') is-invalid @enderror"
        value="{{ old('lastname', $employee->lastname) }}">
    @error('lastname') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label for="name">Nombre</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $employee->name) }}">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label for="username">Nombre de usuario</label>
    <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
        value="{{ old('username', $user->username) }}">
    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="form-group">
    <label for="roles">Roles</label>
    <select id="roles" name="roles[]" multiple class="form-control is-invalid @error('roles') is-invalid @enderror">
        @foreach ($roles as $role)
        <option @if($user->roles)
            {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}
            @endif
            value="{{ $role->id }}">{{ $role->isoName }}</option>
        @endforeach
    </select>
    @error('roles') <small class="text-danger">{{ $message }}</small> @enderror
</div>