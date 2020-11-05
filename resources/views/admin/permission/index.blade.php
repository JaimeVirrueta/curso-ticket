@extends('layouts.app')

@section('title', 'Listado de Permisos')

@section('icon_title')
    <i class="fa fa-fw fa-key"></i>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@section('content')
    @component('components.card')
        @slot('title', 'Listado de Permisos')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rows as $row)
                    <tr>
                        <td><a href="{{ route('admin.permission.show', $row->id) }}">{{ $row->name }}</a></td>
                        <td>{{ $row->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $rows->render() }}
    @endcomponent

@endsection
