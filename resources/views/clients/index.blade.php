@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="input-group mb-2">
    <input type="text" class="form-control" id="searchInput">
    <div class="input-group-append">
        <span class="input-group-text"><i class="fas fa-search"></i></span>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr class="card-header">
                <th colspan="6">
                    <div class="d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            Clientes
                        </h6>

                    </div>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Apellido y nombre</th>
                <th>Teléfonos</th>
                <th>Dirección</th>
                <th>Cliente desde</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>
                    <a href="{{ route('clients.show', ['client' => $client->id]) }}">
                        {{ $client->full_name }}
                    </a>
                </td>
                <td>
                    @foreach ($client->phones as $phone)
                    <span class="badge badge-primary">{{ $phone->formatted_number }}</span>
                    @endforeach
                </td>
                <td>{{ $client->address->formatted_address }}</td>
                <td>{{ $client->created_at->diffForHumans() }}</td>
                <td>

                    @foreach ($client->phones as $phone)
                    @if($phone->has_whatsapp)
                    <a href="{{ route('whatsapp.send', ['phone' => $phone->id]) }}" class="ml-1 btn btn-sm btn-success"
                        target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    @endif
                    <a href="tel:{{ $phone->area_code.$phone->number }}" class="ml-1 btn btn-sm btn-primary"
                        target="_blank">
                        <i class="fas fa-phone"></i>
                    </a>
                    @endforeach
                    @if ($client->address->has_location)
                    <a href="{{ route('map.show', ['client' => $client->id]) }}" class="ml-1 btn btn-sm btn-warning">
                        <i class="fas fa-map-marker"></i>
                    </a>
                    @endif

                    <a href="{{ route('clients.show', ['client' => $client->id]) }}" class="btn btn-sm btn-info"><i
                            class="fas fa-eye"></i></a>
                    <a href="{{ route('clients.edit', ['client' => $client->id]) }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');

    const filter = () => {
        const params = searchInput.value.toLowerCase();
        const searchables = document.querySelectorAll('.table-bordered tbody tr');
        
        if(!params) {
            searchables.forEach(searchable => searchable.classList.remove('d-none'));
        }

        searchables.forEach(searchable => {
            searchable.classList.add('d-none');

            const containsId = searchable.querySelectorAll('td')[0].innerText.trim().toLowerCase().includes(params);
            const containsFullName = searchable.querySelectorAll('td')[1].innerText.trim().toLowerCase().includes(params);
            const containsPhone = searchable.querySelectorAll('td')[2].innerText.trim().toLowerCase().includes(params);
            const containsAddress = searchable.querySelectorAll('td')[3].innerText.trim().toLowerCase().includes(params);
            
            if(containsId || containsFullName || containsPhone || containsAddress) {
                searchable.classList.remove('d-none');
            }
        });
    }

    searchInput.addEventListener('input', filter);
</script>
@endsection