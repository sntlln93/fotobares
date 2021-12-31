@extends('layouts.app')

@section('title', 'Clientes')

@php
$activeOnly = Str::contains(url()->full(), 'active=1');
@endphp

@section('content')
<div class="row">
    <div class="input-group col-sm-12 col-md-6 mb-2">
        <input type="text" class="form-control" id="searchInput">
        <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 mb-2">
        <button class="btn btn-sm btn-light border h-100 {{ $activeOnly ? 'filter--active' : '' }}">
            <a class="btn btn-sm {{ $activeOnly ? 'text-white' : 'text-dark'}}" href=" {{ $activeOnly ? route('clients.index') : route('clients.index',
                ['active' => true]) }}">
                <span class="d-sm-none d-md-inline">Con entregas pendientes</span>
                <i class="fas fa-box"></i>
            </a></button>
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
        <tbody></tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
    const clients = Object.values(@json($clients));
    const tableBody = document.querySelector('tbody');
    const routes = {
        show: '{{ route('clients.show', ':client') }}',
        edit: '{{ route('clients.edit', ':client') }}',
        map: '{{ route('map.show', ':client') }}',
        call: 'tel::number',
        whatsapp: '{{ route('whatsapp.send', ':phone') }}'
    }

    const renderClients = (clientsToRender) => {
        tableBody.innerHTML = '';

        clientsToRender
        .sort((c1, c2) => c2.id - c1.id)
        .forEach(client => {
            const tr = document.createElement('tr');

            const whatsappBtns = client.phones.reduce((acc, phone) => acc += `<a href="${ routes.whatsapp.replace(':phone', phone.id) }" class="ml-1 btn btn-sm btn-success"
                        target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>`, '');

            const callBtns = client.phones.reduce((acc, phone) => acc += `<a href="${ routes.call.replace(':number', phone.area_code + phone.number) }" class="ml-1 btn btn-sm btn-primary"
                target="_blank">
                <i class="fas fa-phone"></i>
            </a>`, '');
            

            const phones = client.phones.reduce((acc, phone) => acc += `<span class="badge badge-primary mr-1">${ phone.area_code + ' ' + phone.number }</span>`, '');

            tr.innerHTML = `
            <tr>
                <td>${ client.id }</td>
                <td>
                    <a href="${ routes.show.replace(':client', client.id) }">
                        ${ client.fullName }
                    </a>
                </td>
                <td>${ phones }</td>
                <td>${ client.address }</td>
                <td>${ client.createdAt }</td>
                <td>
                    ${ callBtns }
                    ${ whatsappBtns }
                    <a href="${ routes.map.replace(':client', client.id)}" class="ml-1 btn btn-sm btn-warning">
                        <i class="fas fa-map-marker"></i>
                    </a>

                    <a href="${ routes.show.replace(':client', client.id) }" class="btn btn-sm btn-info"><i
                            class="fas fa-eye"></i></a>

                    <a href="${ routes.edit.replace(':client', client.id) }" class="btn btn-sm btn-warning"><i
                            class="fas fa-edit"></i></a>
                </td>
            </tr>
            `;
            tableBody.appendChild(tr);
        });
    }

    renderClients(clients);
</script>
<script>
    const searchInput = document.querySelector('#searchInput');

    const flattenObj = (obj, parent, res = {}) => {
        for(let key in obj){
            let propName = parent ? parent + '_' + key : key;
            if(typeof obj[key] == 'object'){
                flattenObj(obj[key], propName, res);
            } else {
                res[propName] = obj[key];
            }
        }
        return res;
    }

    const searchOnClients = () => {
        const params = searchInput.value.toLowerCase();
        const toRender = clients.filter(sale => Object.values(flattenObj(sale)).some(s => String(s).toLowerCase().includes(params)));
        
        toRender.length > 0 
            ? renderClients(toRender)
            : tableBody.innerHTML = '<tr><td colspan="8" class="text-center">No hay clientes que coincidan con la búsqueda</td></tr>';
    }

    searchInput.addEventListener('input', searchOnClients);

</script>
@endsection