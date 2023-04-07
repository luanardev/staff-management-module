<div>
    @if($browseMode)
        @include('staffmanagement::livewire.profile.profile.view')
    @endif

    @if($editMode)
        @include('staffmanagement::livewire.profile.profile.update')
    @endif
</div>
