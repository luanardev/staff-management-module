<div>
    @if($browseMode)
        @include('staffmanagement::livewire.registration.supervision.view')
    @endif

    @if ($createMode)
        @include('staffmanagement::livewire.registration.supervision.create')
    @endif
</div>
