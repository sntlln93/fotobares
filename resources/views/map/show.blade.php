@extends('layouts.app')

@section('title', 'Ubicación de '. $client->full_name)

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
        <h6 class="m-0 font-weight-bold text-primary">Ubicación de {{ $client->full_name }}</h6>
    </div>
    <div class="card-body p-0">
        <div id="map"></div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const BASE_URL = "{{ env('APP_URL') }}";
    const clients = [{
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
        }];
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap" async defer></script>
<script src="{{ asset('js/views/map/map.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
@endsection