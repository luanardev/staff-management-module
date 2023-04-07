<div>
    @if($browseMode)
        @include('staffmanagement::livewire.profile.kinsman.view')
    @endif

    @if($createMode||$editMode)
        @include('staffmanagement::livewire.profile.kinsman.update')
    @endif
</div>
