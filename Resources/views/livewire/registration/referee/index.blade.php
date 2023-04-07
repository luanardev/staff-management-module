<div>
    @if($browseMode )
        @include('staffmanagement::livewire.registration.referee.view')
    @endif
    @if($createMode )
        @include('staffmanagement::livewire.registration.referee.create')
    @endif
</div>
