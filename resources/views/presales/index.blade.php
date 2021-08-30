@extends('layouts.app')

@section('title', 'Ventas')

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Ventas</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Apellido y nombre</th>
                        <th>Teléfono</th>
                        <th>Información adicional</th>
                        <th>Fecha añadido</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presales as $presale)
                    <tr>
                        <td>{{ $presale->full_name }}</a>
                        </td>
                        <td>{{ $presale->formatted_number }}</td>
                        <td>{{ $presale->information }}</td>
                        <td>{{ $presale->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="tel:{{ $presale->area_code }}{{ $presale->number }}"
                                class="btn btn-sm btn-primary"><i class="fas fa-phone"></i></a>
                            <a href="{{ route('presale.create', ['presale' => $presale->id]) }}"
                                class="btn btn-sm btn-success"><i class="fas fa-dollar-sign"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection