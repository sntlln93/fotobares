@extends('layouts.app')

@section('title', 'Empleados')

@section('styles')
<style>
    td {
        white-space: nowrap;
    }
</style>
@endsection

@section('content')

<div class="table-responsive">
    <table class="table table-bordered bg-white">
        <thead>
            <tr class="card-header">
                <th colspan="6">
                    <div class="py-2">
                        <h6 class="m-0 font-weight-bold text-primary d-flex align-items-center justify-content-between">
                            Empleados
                            <a href="{{ route('employees.create') }}" class="btn btn-primary"><i
                                    class="fas fa-plus mr-2"></i>Nuevo
                                empleado</a>
                        </h6>
                    </div>
                </th>
            </tr>
            <tr>
                <th>#</th>
                <th>Apellido y nombre</th>
                <th>Usuario</th>
                <th>Roles</th>
                <th>Miembro desde</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>
                    <a href="{{ route('employees.show', ['employee' => $employee->id]) }}">
                        {{ $employee->full_name }}
                    </a>
                </td>
                <td>{{ $employee->user?->username }}</td>
                <td>
                    @foreach ($employee->user?->roles ?? [] as $role)
                    <span class="badge badge-primary">{{ $role->isoName }}</span>
                    @endforeach
                </td>
                <td>{{ $employee->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('employees.show', ['employee' => $employee->id]) }}"
                        class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    @if($employee->user)
                    <a href="{{ route('employees.edit', ['employee' => $employee->id]) }}"
                        class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>


                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                        data-target="#delete{{ $employee->user_id }}"><i class="fas fa-trash"></i></button>

                    <div class="modal fade" id="delete{{ $employee->user_id }}" tabindex="-1"
                        aria-labelledby="deleteEmployee" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteEmployee">Eliminar empleado</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('employees.destroy', ['user' => $employee->user_id]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        ¿Está seguro que desea eliminar al empleado {{ $employee->full_name }}? Esta
                                        acción no puede deshacerse.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection