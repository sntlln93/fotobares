@extends('layouts.app')

@section('title', 'Ubicación de clientes')

@section('styles')
<style>
    #map {
        height: 75vh;
        width: 100%;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">Ubicación de clientes</h6>
    </div>
    <div class="card-body p-0">
        <div id="map"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const BASE_URL = "{{ env('APP_URL') }}";
    
    const clients = [];
    @foreach($clients as $client)
        clients.push({
            id: "{{ $client->id }}",
            name: "{{ $client->full_name }}",
            sale_id: "{{ $client->sales->first()->id }}",
            address: {
                street: "{{ $client->address->street }}",
                number: "{{ $client->address->number ?? 'S/N' }}",
                indications: "{{ $client->address->indications }}",
                photo: "{{ $client->address->photo }}",
                lat: {{ $client->address->lat }},
                lon: {{ $client->address->lon }}
            }
        });
    @endforeach
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap" async defer></script>
@if($clients->count() > 0)
<script src="{{ asset('js/views/map/map.js') }}"></script>
@endif
@endsection