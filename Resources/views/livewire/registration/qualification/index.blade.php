<div>
    @if($browseMode)
        @include('staffmanagement::livewire.registration.qualification.view')
    @endif

    @if ($createMode)
        @include('staffmanagement::livewire.registration.qualification.create')
    @endif
</div>
