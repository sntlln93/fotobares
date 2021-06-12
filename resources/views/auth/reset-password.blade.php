@extends('layouts.app')

@section('styles')
@endsection

@section('title', "Cambiar contraseña")

@section('content')

<div class="row px-2">
  <div class="col-sm-12 col-md-8 mx-auto">
    <form action="{{ route('password.update') }}" method="POST" class="needs-validation" novalidate>
      @csrf

      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <div class="form-row mb-2">
        <div class="col-sm-12">
          <label for="current_password">Contraseña actual</label>
          <input type="password" class="form-control" id="current_password" name="current_password"
            placeholder="Colocá tu contraseña actual" required>
          <div class="invalid-feedback">
            Por favor escribí una contraseña
          </div>
          @error('current_password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <span class="invalid-feedback" role="alert">
            <strong>{{ $error ?? '' }}</strong>
          </span>
        </div>
      </div>

      <div class="form-row mb-2">
        <div class="col-sm-12">
          <label for="password">Nueva contraseña</label>
          <input type="password" class="form-control" id="password" name="password"
            placeholder="Colocá la nueva contraseña" required>
          <div class="invalid-feedback">
            Por favor escribí tu nueva contraseña
          </div>
          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <div class="form-row mb-2">
        <div class="col-sm-12">
          <label for="password_confirmation">Repetí tu nueva contraseña</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
            placeholder="Repeti tu nueva contraseña" required>
          <div class="invalid-feedback">
            Por favor escribí nuevamente la contraseña que querés poner
          </div>
          @error('password_confirmation')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>

      <button class="my-3 btn btn-primary w-100" type="submit">Guardar</button>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  // Example starter JavaScript for disabling form submissions if there are invalid fields
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
</script>
@endsection