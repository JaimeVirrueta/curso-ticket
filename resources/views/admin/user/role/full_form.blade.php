<div class="tab-pane" id="roles">
    {!! Form::open(['route' => ['admin.user.role', $row->id], 'method' => 'patch']) !!}
        <div class="row">
        @foreach ($roles as $role)
            <div class="col-12">
                {!! Field::checkbox(
                    "roles[{$role->id}]",
                    $role->id,
                    $row->hasRole($role->id),
                    [
                        'label' => $role->description
                    ]
                ) !!}
            </div>
        @endforeach
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
