@extends('layouts.app')

@section('title', 'Visualización del Permiso')

@section('icon_title')
    <i class="fa fa-fw fa-key"></i>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@section('content')
    @component('components.card')
        @slot('title', 'Detalle del Permiso')
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

    @component('components.card')
        @slot('title', 'Roles Asignados')

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @can('admin-role-show')
                    @foreach ($row->roles as $role)
                        <tr>
                            <td><a href="{{ route('admin.role.show', $row->id) }}">{{ $role->name }}</a></td>
                            <td>{{ $role->description }}</td>
                        </tr>
                    @endforeach
                @else
                    @foreach ($row->roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                        </tr>
                    @endforeach
                @endcan

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

                {{-- @php
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
                @endforeach --}}

            </tbody>
        </table>
    @endcomponent
@endsection
