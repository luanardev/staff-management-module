<div>
    @if($browseMode)
        @include('staffmanagement::livewire.registration.experience.view')
    @endif

    @if ($createMode)
        @include('staffmanagement::livewire.registration.experience.create')
    @endif
</div>
