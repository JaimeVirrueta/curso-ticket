@extends('layouts.app')

@section('title', 'Visualización del Usuario')

@section('icon_title')
    <i class="fa fa-fw fa-key"></i>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.permission.index') }}">Permisos</a></li>
@endsection

@section('content')
<div class="row">
    Listado de usuarios que tiene este permiso
</div>
@endsection
