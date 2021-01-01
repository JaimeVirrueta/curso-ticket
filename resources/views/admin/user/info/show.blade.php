@php
    $can_edit = auth()->user()->can('admin-user-edit');
    $can_image = auth()->user()->can('admin-user-image');
    $disabled = $can_edit ? '' : 'disabled';
@endphp

<div class="tab-pane" id="settings">
    @if ($can_edit) {!! Form::open(['route' => ['admin.user.update', $row->id], 'method' => 'patch']) !!} @endif
        <div class="row">
            <div class="col-12 col-md-6">
                {!! Field::text('first_name', $row->first_name, ['required' => true, 'placeholder' => 'Nombres', $disabled]) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::text('last_name', $row->last_name, ['placeholder' => 'Apellidos', $disabled]) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::email('email', $row->email, ['required' => true, 'placeholder' => 'Correo electrónico', $disabled]) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::text('username', $row->username, ['required' => true, 'placeholder' => 'usuario', $disabled]) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::date('start_date', substr($row->start_date, 0, 10), [$disabled]) !!}
            </div>
            <div class="col-12 col-md-6 pt-2">
                @if ($can_image)
                    <button type="button" class="btn btn-default mt-4 btn-outline-success" data-toggle="modal" data-target="#image-modal">
                        <i class="fa fa-fa fw- fa-image"></i> Cambiar Imagen
                    </button>
                @endif
            </div>
        </div>
        @if ($can_edit)
            <div class="row">
                <div class="col-12">
                    <div class="float-right">
                        <button type="submit" class="ml-2 btn btn-success">Grabar</button>
                    </div>
                </div>
            </div>
        @endif
    @if ($can_edit) {!! Form::close() !!} @endif
</div>
