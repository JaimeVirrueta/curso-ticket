@extends('layouts.app')

@section('title', 'Creacion de Rol')

@section('icon_title')
    <i class="fa fa-fw fa-unlock-alt"></i>
@endsection

@section('content')
{!! Form::open(['route' => 'admin.role.store', 'method' => 'post']) !!}
    @include('admin.role.form', [
        'link_cancel' => route('admin.role.index')
    ])
{!! Form::close() !!}
@endsection
