@extends('layouts.app')

@section('title', 'Productos')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Productos</h6>
        <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-2"></i>Nuevo
            producto</a>
    </div>
    <div class="card-body row">
        @foreach ($products as $product)
        <div class="card mr-2 mb-2">
            <img class="card-img-top" src="https://via.placeholder.com/350x150" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>

                {{-- 
                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-sm btn-info">
                <i class="fas fa-eye mr-2"></i>Ver
                </a>
                --}}
                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit mr-2"></i>Editar
                </a>
                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete{{ $product->id }}">
                    <i class="fas fa-trash mr-2"></i>Eliminar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="delete{{ $product->id }}Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('products.delete', ['product' => $product->id]) }}" method="POST">
                            @csrf @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="delete{{ $product->id }}Label">Eliminar producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de querer eliminar {{ $product->name }}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection