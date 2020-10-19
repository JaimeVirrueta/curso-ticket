<div class="card">
    <div class="card-header p-2">
        <ul class="nav nav-pills">
            {!! $tabs !!}
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            {{ $slot }}
        </div>
    </div>
</div>
