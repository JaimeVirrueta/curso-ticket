@component('components.card')
    @slot('title', 'Información del Rol')

    <div class="row">
        <div class="col-12 col-md-4">
            {!! Field::text('name', $row->name, ['placeholder' => 'nombre del rol']) !!}
        </div>
        <div class="col-12 col-md-8">
            {!! Field::text('description', $row->description, ['placeholder' => 'descripcion del rol']) !!}
        </div>
    </div>
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="float-right">
            <a href="{{ $link_cancel }}" class="btn btn-outline-danger">Cancelar</a>
            <button type="submit" class="ml-2 btn btn-success">Grabar</button>
        </div>
    </div>
</div>
