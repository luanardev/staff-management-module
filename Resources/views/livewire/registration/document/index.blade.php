<div>
    @if($browseMode)
        @include('staffmanagement::livewire.registration.document.view')
    @endif

    @if ($createMode)
        @include('staffmanagement::livewire.registration.document.create')
    @endif
</div>
