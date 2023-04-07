<div>
    @if ($browseMode)
        @include('staffmanagement::livewire.registration.dependant.view')
    @endif
    @if($createMode)
        @include('staffmanagement::livewire.registration.dependant.create')
    @endif
</div>
