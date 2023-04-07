<div>
    @if($browseMode)
        @include('staffmanagement::livewire.profile.supervisor.view')
    @endif

    @if ($createMode)
        @include('staffmanagement::livewire.profile.supervisor.create')
    @endif
</div>
