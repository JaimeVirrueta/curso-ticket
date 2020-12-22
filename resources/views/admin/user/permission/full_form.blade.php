<div class="tab-pane" id="permissions">
    {!! Form::open(['route' => ['admin.user.permission', $row->id], 'method' => 'patch']) !!}
        <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-12">
                {!! Field::checkbox(
                    "permissions[{$permission->id}]",
                    $permission->id,
                    $row->hasPermissionTo($permission->id),
                    ['label' => $permission->description
                ]) !!}
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
