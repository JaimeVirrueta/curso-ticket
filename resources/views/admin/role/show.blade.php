@extends('layouts.app')

@section('title', 'Visualización del Rol')

@section('icon_title')
    <i class="fa fa-fw fa-unlock-alt"></i>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.role.index') }}">Roles</a></li>
@endsection

@section('content')
    @component('components.card')
        @slot('title', 'Detalle del Rol')

        @slot('action')
            <a href="{{ route('admin.role.edit', $row->id) }}" title="Editar Rol">
                <i class="fa fa-edit"></i>
            </a>
            <a href="javascript:{}" onclick="document.getElementById('form_delete').submit(); return false;" class="dropdown-item" title="Eliminar Rol">
                <i class="fa fa-trash text-danger"></i>
            </a>
            <form method="post" action="{{ route('admin.role.destroy', $row->id) }}" id="form_delete">
                <input type="hidden" name="_method" value="delete">
                @csrf
            </form>
        @endslot

        <div class="row">
            <div class="col-12 col-md-4">
                <p><b>Nombre</b> <br> {{ $row->name }}</p>
            </div>
            <div class="col-12 col-md-8">
                <p><b>Descripción</b> <br> {{ $row->description }}</p>
            </div>
        </div>
    @endcomponent

    @component('components.card')
        @slot('title', 'Permisos Asignados')

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                {{-- @can('admin-permission-show')
                    @foreach ($row->permissions as $permission)
                        <tr>
                            <td><a href="{{ route('admin.permission.show', $row->id) }}">{{ $permission->name }}</a></td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($row->permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->description }}</td>
                        </tr>
                    @endforeach
                @endcan --}}

                {{-- @foreach ($row->permissions as $permission)
                    <tr>
                        <td>
                            @can('admin-permission-show')
                                <a href="{{ route('admin.permission.show', $row->id) }}">
                                    {{ $permission->name }}
                                </a>
                            @else
                                {{ $permission->name }}
                            @endcan
                        </td>
                        <td>{{ $permission->description }}</td>
                    </tr>
                @endforeach --}}

                @php
                    $can_view_permissions = auth()->user()->can('admin-permission-show');
                @endphp

                @foreach ($row->permissions as $permission)
                    <tr>
                        <td>
                            @if($can_view_permissions)
                                <a href="{{ route('admin.permission.show', $row->id) }}">
                                    {{ $permission->name }}
                                </a>
                            @else
                                {{ $permission->name }}
                            @endif
                        </td>
                        <td>{{ $permission->description }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endcomponent

    @component('components.card')
        @slot('title', 'Usuarios Asignados')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombres y Apellidos</th>
                        <th>Login</th>
                        <th>Correo Electrónico</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($row->users as $user)
                        <tr>
                            <td><a href="{{ route('admin.user.show', $row->id) }}">{{ $user->first_name . ' ' . $user->last_name}}</a></td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endcomponent
@endsection

@if( session()->has('process_result') )
    @section('scripts')
        <script>
            $(function() {
                toastr.{{ session('process_result')['status'] }}('{{ session('process_result')['content'] }}')
            });
        </script>
    @endsection
@endif
