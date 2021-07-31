@extends('layouts.app')

@section('title', $client->full_name)

@section('content')


<div class="row px-2">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total pagado</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $client->total_paid }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Saldo</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $client->balance }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Comprado</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->sales->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pagos completados</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    {{ $client->completed_payments_percentage }}%
                                </div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $client->completed_payments_percentage }}%"
                                        aria-valuenow="{{ $client->completed_payments_percentage }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row px-2 mb-4">

    <div class="col-sm-12">
        <div class="card my-4">
            <div class="card-header">
                Datos personales
                <a class="btn btn-sm btn-warning" href="{{ route('clients.edit', ['client' => $client->id]) }}"><i
                        class="fas fa-edit"></i></a>
            </div>
            <div class="card-body">
                <p><b>Nombres:</b> {{ $client->name }}</p>
                <p><b>Apellidos:</b> {{ $client->lastname }}</p>
                <p><b>DNI:</b> {{ $client->dni }}</p>
            </div>
        </div>
    </div>

</div>


<div class="row">

    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Dirección
                <a href="{{ route('addresses.edit', ['address' => $client->address->id]) }}"
                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
            </div>
            <div class="card-body d-flex d-row">
                <div>
                    <p class="mb-0"><b>Localidad</b><br> {{ $client->address->city }}</p>
                    <p class="mb-0"><b>Barrio</b><br> {{ $client->address->neighborhood }}</p>
                    <p class="mb-0"><b>Calle</b><br> {{ $client->address->street }} al
                        {{ $client->address->number ?? "S/N" }}
                    </p>
                    <p class="mb-0"><b>Indicaciones</b><br> {{ $client->address->indications }}</p>
                    <p class="mb-0"><b>Detalles de la casa</b><br> {{ $client->address->details }}</p>
                </div>
                <div class="w-50">
                    <img class="img-fluid" src="{{ asset('storage/'.$client->address->photo) }}" alt="">
                </div>
            </div>
        </div>
    </div>

    @forelse($client->phones as $phone)
    <div class="col-sm-6">
        <div class="card">
            <div class="card-header">
                Teléfonos
            </div>
            <div class="card-body">
                <p><b>Número:</b> {{ $phone->formatted_number }}
                    <a href="{{ route('phones.edit', ['phone' => $phone->id]) }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-edit"></i></a>
                    <a href="tel:{{ $phone->area_code }}{{ $phone->number }}" class="btn btn-sm btn-primary"><i
                            class="fas fa-phone"></i></a>
                    @if($phone->has_whatsapp)
                    <a target="_blank" href="{{ route('whatsapp.send', ['phone' => $phone->id]) }}"
                        class="btn btn-sm btn-success"><i class="fab fa-whatsapp"></i></a>
                    @endif
                </p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-sm-6">
        <div class="card my-4">
            <div class="card-header">
                Teléfono
                <a class="btn btn-link text-primary"
                    href="{{ url('phone/'.$client->photos->first()->id.'/create') }}"><i class="fas fa-plus"></i></a>

            </div>
            <div class="card-body">
                No hay un teléfono registrado para este cliente
            </div>
        </div>
    </div>
    @endforelse


</div>

@endsection

@section('scripts')
<script>
    if(navigator.geolocation){
      let latInputs = document.getElementsByClassName("latInput");
      let lonInputs = document.getElementsByClassName("lonInput");

      navigator.geolocation.getCurrentPosition((position) => {
        Array.from(latInputs).forEach(latInput => {
          latInput.value = position.coords.latitude;
        });

        Array.from(lonInputs).forEach(lonInput => {
          lonInput.value = position.coords.longitude;
        });
      });
      
    } else {
      console.log("Tu navegador no soporta funciones de geolocalización");
    }
</script>
@endsection