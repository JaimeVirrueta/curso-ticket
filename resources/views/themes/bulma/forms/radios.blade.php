@php
    $classes = 'form-check-input';
    if ($hasErrors) {
        $classes .= ' is-invalid';
    }
@endphp
@foreach($radios as $radio)
    <div class="control">
        {!! Form::radio(
            $radio['name'],
            $radio['value'],
            $radio['selected'],
            ['class' => $classes, 'id' => $radio['id']]) !!}
        <label class="radio" for="{{ $radio['id'] }}">
            {{ $radio['label'] }}
        </label>
    </div>
@endforeach