@extends('layouts.app')

@section('title', 'Modificar empleado')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar empleado {{ $employee->full_name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="POST"
            class="col-sm-12 col-md-8 offset-md-2">
            @method('PUT')
            @include('employees._form', ['user' => $employee->user])

            <button class="btn btn-primary" type="submit">Modificar empleado</button>
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