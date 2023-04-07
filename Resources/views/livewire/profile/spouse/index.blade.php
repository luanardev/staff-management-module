<div>
    @if($browseMode)
        @include('staffmanagement::livewire.profile.spouse.view')
    @endif

    @if($createMode||$editMode)
        @include('staffmanagement::livewire.profile.spouse.update')
    @endif
</div>
