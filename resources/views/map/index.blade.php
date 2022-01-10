@extends('map._layout')

@section('title', 'Ubicación de clientes')

@section('content')
<div id="map"></div>
@endsection

@section('scripts')
<script>
    fetch(`${BASE_URL}/map/?clients=${localStorage.getItem('clients')}`)
    .then(response => response.json())
    .then(clients => initMap(clients))
    .catch(error => console.error(error));
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('MAP_KEY') }}&callback=initMap" async defer></script>
<script src="{{ asset('js/utils/time.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
<script src="{{ asset('js/views/map/map.js') }}?ts={{ env('APP_ASSET_VERSIONING') }}"></script>
@endsection