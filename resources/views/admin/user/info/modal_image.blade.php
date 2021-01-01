<div class="modal fade" id="image-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Agregar Imagen</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            {!! Form::open(['route' => ['admin.user.image', $row->id], 'method' => 'patch', 'files' => true]) !!}
                <div class="modal-body">
                    {!! Field::file('image') !!}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-outline-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Grabar</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
