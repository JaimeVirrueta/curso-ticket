<div class="tab-pane" id="roles">
    <div class="row">
    @foreach ($roles as $role)
        <div class="col-12">
            {!! Field::checkbox(
                "roles[{$role->id}]",
                $role->id,
                $row->hasRole($role->id),
                [
                    'label' => $role->description,
                    'disabled' => 'diisabled'
                ]
            ) !!}
        </div>
    @endforeach
    </div>
</div>
