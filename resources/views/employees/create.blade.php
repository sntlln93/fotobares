@extends('layouts.app')

@section('title', 'Nuevo empleado')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo empleado</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('employees.store') }}" method="POST" class="col-sm-12 col-md-8 offset-md-2">
            @include('employees._form', ['employee' => new \App\Models\Employee, 'user' => new \App\Models\User])

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button class="btn btn-primary" type="submit">Guardar nuevo empleado</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#roles').select2();
    })
</script>
@endsection