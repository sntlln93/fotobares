@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/parents.css') }}" />
@endsection

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
                Datos personales <a class="btn btn-link text-warning"
                    href="{{ url('clients/'.$client->id.'/edit') }}"><i class="fas fa-edit"></i></a>
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
                <a class="btn btn-link text-primary" href="{{ url('address/1/create') }}"><i
                        class="fas fa-plus"></i></a>
            </div>
            <div class="card-body">
                <p><b>Localidad:</b> {{ $client->address->city }}</p>
                <p><b>Barrio:</b> {{ $client->address->neighborhood }}</p>
                <p><b>Calle:</b> {{ $client->address->street }} al {{ $client->address->number ?? "S/N" }}</p>
                @if($client->address->apartment)
                <p><b>Piso:</b> {{ $client->address->floor }}</p>
                <p><b>Departamento:</b> {{ $client->address->apartment }}</p>
                @endif
            </div>
        </div>
    </div>

    @forelse($client->phones as $phone)
    <div class="col-sm-6">
        <div class="card my-4">
            <div class="card-header">
                Teléfono <a class="btn btn-link text-warning" href="{{ url('phone/'.$phone->id.'/edit') }}"><i
                        class="fas fa-edit"></i></a>
            </div>
            <div class="card-body">
                <p><b>Número:</b> {{ $phone->full_number }}</p>
                <p><b>Whatsapp:</b> {{ $phone->has_whatsapp ? "Sí" : "No" }}</p>
                @if($phone->has_whatsapp)
                <a target="_blank"
                    href="https://api.whatsapp.com/send?phone=54{{ $phone->full_number }}&text=Hola%2C%20{{  $client->name  }}%21&source=&data=&app_absent="
                    class="btn btn-primary">Abrir en Whatsapp</a>
                @endif
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