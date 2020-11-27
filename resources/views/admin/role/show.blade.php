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
        @slot('title', 'Usuarios Asignados')
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
