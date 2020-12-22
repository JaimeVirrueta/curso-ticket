<div class="tab-pane" id="permissions">
    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-12">
                {!! Field::checkbox(
                    "permissions[{$permission->id}]",
                    $permission->id,
                    $row->hasPermissionTo($permission->id),
                    [
                        'label' => $permission->description,
                        'disabled' => 'disabled'
                    ]
                ) !!}
            </div>
        @endforeach
    </div>
</div>
