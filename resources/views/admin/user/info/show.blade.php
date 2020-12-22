<div class="tab-pane" id="settings">
    {!! Form::open(['route' => ['admin.user.update', $row->id], 'method' => 'patch']) !!}
        <div class="row">
            <div class="col-12 col-md-6">
                {!! Field::text('first_name', $row->first_name, ['required' => true, 'placeholder' => 'Nombres']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::text('last_name', $row->last_name, ['placeholder' => 'Nombres']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::email('email', $row->email, ['required' => true, 'placeholder' => 'Nombres']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::text('username', $row->username, ['required' => true, 'placeholder' => 'Nombres']) !!}
            </div>
            <div class="col-12 col-md-6">
                {!! Field::date('start_date', substr($row->start_date, 0, 10), ['placeholder' => 'Nombres']) !!}
            </div>
            <div class="col-12 col-md-6 pt-2">
            <button type="button" class="btn btn-default mt-4 btn-outline-success" data-toggle="modal" data-target="#image-modal">
                <i class="fa fa-fa fw- fa-image"></i> Cambiar Imagen
            </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    <button type="submit" class="ml-2 btn btn-success">Grabar</button>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
