@extends('layouts.app')

@section('title', 'Nuevo producto')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo producto</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" class="col-sm-12 col-md-8 offset-md-2">
            @csrf
            @include('products._form')

            <button class="btn btn-primary" type="submit">Guardar producto</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/products/create.js') }}"></script>
@endsection