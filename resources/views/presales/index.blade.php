@extends('layouts.app')

@section('title', 'Preventas')

@section('content')

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr class="card-header">
                <th colspan="8">
                    <div class="py-2">
                        <h6 class="m-0 font-weight-bold text-primary">Preventas</h6>
                    </div>
                </th>
            </tr>
            <tr>
                <th>Apellido y nombre</th>
                <th>Teléfono</th>
                <th>Información adicional</th>
                <th>Dirección</th>
                <th>Fecha añadido</th>
                <th>Fecha de contacto</th>
                <th>Preventista</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presales as $presale)
            <tr>
                <td>{{ $presale->full_name }}</a>
                </td>
                <td>{{ $presale->phone->formatted_number }}</td>
                <td>{{ $presale->information }}</td>
                <td>{{ $presale->full_address }}</td>
                <td>{{ $presale->created_at->diffForHumans() }}</td>
                <td>{{ $presale->contact_date?->isoFormat('D [de] MMMM [de] Y') }}</td>
                <td>{{ $presale->seller->full_name }}</td>
                <td>
                    <a href="{{ route('presale.create', ['presale' => $presale->id]) }}"
                        class="btn btn-sm btn-success"><i class="fas fa-dollar-sign"></i></a>
                    @if($presale->phone)
                    <a href="tel:{{ $presale->phone->area_code.$presale->phone->number }}"
                        class="ml-1 btn btn-sm btn-primary" target="_blank">
                        <i class="fas fa-phone"></i>
                    </a>
                    <a href="{{ route('whatsapp.send', ['phone' => $presale->phone]) }}" class="btn btn-sm btn-success"
                        target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                    <a href="#" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection