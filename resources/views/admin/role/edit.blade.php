@extends('layouts.app')

@section('title', 'Edición del Rol')

@section('icon_title')
    <i class="fa fa-fw fa-unlock-alt"></i>
@endsection

@section('content')
{!! Form::open(['route' => ['admin.role.update', $row->id], 'method' => 'patch']) !!}
    @include('admin.role.form', [
        'link_cancel' => route('admin.role.show', $row->id)
    ])
{!! Form::close() !!}
@endsection
