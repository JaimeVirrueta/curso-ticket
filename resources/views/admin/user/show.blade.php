@extends('layouts.app')

@section('title', 'Visualización del Usuario')

@section('icon_title')
    <i class="fa fa-fw fa-user"></i>
@endsection

@section('breadcrumbs')
    <li class="breadcrumb-item active"><a href="{{ route('admin.user.index') }}">Usuarios</a></li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{ asset('storage/image_profiles/'.$row->image_path) }}"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $row->first_name.' '.$row->last_name }}</h3>

          <p class="text-muted text-center">{{ $row->username }}</p>

        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Sobre Mi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-book mr-1"></i> Education</strong>

          <p class="text-muted">
            B.S. in Computer Science from the University of Tennessee at Knoxville
          </p>

          <hr>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

          <p class="text-muted">Malibu, California</p>

          <hr>

          <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

          <p class="text-muted">
            <span class="tag tag-danger">UI Design</span>
            <span class="tag tag-success">Coding</span>
            <span class="tag tag-info">Javascript</span>
            <span class="tag tag-warning">PHP</span>
            <span class="tag tag-primary">Node.js</span>
          </p>

          <hr>

          <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

          <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        @component('components.tabs')
            @slot('tabs')
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Actividad</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Historial</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Información</a></li>
                <li class="nav-item"><a class="nav-link" href="#roles" data-toggle="tab">Roles</a></li>
                <li class="nav-item"><a class="nav-link" href="#permissions" data-toggle="tab">Permisos</a></li>
            @endslot

            @include('admin.user.activity.show')
            @include('admin.user.timeline.show')
            @include('admin.user.info.show')
            @include('admin.user.role.'.(auth()->user()->can('admin-user-role') ? 'full_form' : 'limited_form'))
            @include('admin.user.permission.'.(auth()->user()->can('admin-user-permission') ? 'full_form' : 'limited_form'))

        @endcomponent

    </div>

    @includeWhen(auth()->user()->can('admin-user-image'), 'admin.user.info.modal_image')
</div>
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
