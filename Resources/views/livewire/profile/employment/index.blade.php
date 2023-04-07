<div>
    @if($browseMode)
        @include('staffmanagement::livewire.profile.employment.view')
    @endif

    @if($editMode)
        @include('staffmanagement::livewire.profile.employment.update')
    @endif
</div>
