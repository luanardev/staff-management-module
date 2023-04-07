<div>
    @if($browseMode)
        @include('staffmanagement::livewire.registration.award.view')
    @endif

    @if($createMode)
        @include('staffmanagement::livewire.registration.award.create')
    @endif
</div>
