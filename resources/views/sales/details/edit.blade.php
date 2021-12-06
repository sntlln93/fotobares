@extends('layouts.app')

@section('title', 'Modificar detalle de venta')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            Modificar detalle de venta #{{ $detail->sale_id }}
            de {{ $detail->sale->client->full_name }}
        </h6>

    </div>
    <div class="card-body">
        <form action="{{ route('saleDetail.update', ['saleDetail' => $detail->id]) }}" method="POST">
            @csrf @method('PUT')

            <div class="form-row">
                <h1 class="h4 text-gray-800">Producto</h1>
                <div class="w-100">
                    <label for="product">Elegí un producto</label>
                    <small>Si cambia el producto el precio cambiará, recuerde modificar los pagos si
                        corresponde.</small>
                    <div class="form-group radio--select">
                        <div class="form-group" id="products">

                        </div>
                        @error('product_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group radio--select d-none" id="color-picker">
                        <label for="product">Elegí un color</label>

                        <div class="form-group d-flex" id="colors">

                        </div>
                        @error('color')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="description">Descripción de la foto que irá en el
                                mural <small>(opcional)</small></label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                name="description" id="description"
                                value="{{ old('description', $detail->description) }}">
                            @error('description')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="code">Código <small>(opcional)</small></label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                                id="code" value="{{ old('code', $detail->code) }}">
                            @error('code')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/views/sell/create.css') }}">
@endsection

@section('scripts')
<script>
    const products = @json($products);
    const currentDetail = @json($detail);
    const oldInput = @json(old());
</script>
<script src="{{ asset('js/views/sales/details/edit.js') }}"></script>
@endsection