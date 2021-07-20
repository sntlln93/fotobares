@extends('layouts.app')

@section('title', 'Modificar producto {{ $product->name }}')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Modificar producto {{ $product->name }}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST"
            class="col-sm-12 col-md-8 offset-md-2">
            @csrf @method('PUT')
            @include('products._form')

            <button class="btn btn-primary" type="submit">Guardar producto</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/views/products/create.js') }}"></script>
@endsection