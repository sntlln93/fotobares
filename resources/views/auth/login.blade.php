@extends('auth.app')

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">¡Bienvenido!</h1>
                                </div>
                                <form class="needs-validation user" method="POST" action="{{ route('login') }}"
                                    novalidate>
                                    @csrf
                                    <div class="form-group">
                                        <div class="col-sm-12 |px-0">
                                            <label for="validationCustomUsername">Nombre de usuario</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" name="username" class="form-control"
                                                    id="validationCustomUsername"
                                                    placeholder="Ingresá tu nombre de usuario..."
                                                    aria-describedby="inputGroupPrepend" value="{{ old('username') }}"
                                                    required>
                                                <div class="invalid-feedback">
                                                    Por favor escribí un nombre de usuario válido
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12 |px-0">
                                            <label for="validationCustomUsername">Contraseña</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i
                                                            class="fas fa-key"></i></span>
                                                </div>
                                                <input type="password" name="password" class="form-control"
                                                    id="validationCustomPassword" placeholder="...y tu contraseña"
                                                    aria-describedby="inputGroupPrepend" required>
                                                <div class="invalid-feedback">
                                                    Por favor escribí una contraseña
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">
                                            Ingresar
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <p>Si olvidaste tu contraseña por favor contacta con el administrador.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')

    <script>
        const error = {!! $errors !!}.username ? {!! $errors !!}.username[0] : '';
        error && Swal.fire({
            icon: 'error',
            text: error,
            showConfirmButton: false,
            timer: 3000
        })

    </script>

@endsection
