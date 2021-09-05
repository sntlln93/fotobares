@extends('layouts.app') @section('title', 'Inicio') @section('content')

<div class="row">
    <div class="col-lg-6 px-0 mb-2">
        <div class="card-header px-0">
            <h6 class="h6 m-0 font-weight-bold text-primary">Mis últimas preventas</h6>
        </div>
        <ul class="list-group">
            @forelse ($presales as $presale)
            <li class="
                        list-group-item
                        d-flex
                        justify-content-between
                        align-items-start
                        flex-wrap
                    ">

                <div class="d-flex flex-column">
                    <p class="mb-0">
                        <b>Apellido y nombre:</b>
                        {{ $presale->full_name }}
                    </p>
                    <p class="mb-0">
                        <b>Fecha preventa:</b>
                        {{ $presale->created_at->isoFormat('D [de] MMMM Y') }}
                    </p>
                    <p class="mb-0">
                        <b>Teléfono:</b>
                        {{ $presale->formatted_number}}
                        <a href="tel:{{ $presale->full_number }}" class="btn btn-sm btn-info"><i
                                class="fas fa-phone"></i></a>
                    </p>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                No tenés preventas para mostrar.
            </li>
            @endforelse
        </ul>
    </div>

    <div class="d-sm-none d-lg-block col-lg-1 mb-2"></div>

    <div class="col-lg-5 px-0 mb-2">
        <div class="px-0 card-header d-flex">
            <h6 class="h6 m-0 font-weight-bold text-primary">Mis últimas ventas</h6>
        </div>
        <ul class="list-group">
            @include('sales._sales-list')
        </ul>
    </div>
</div>
@endsection