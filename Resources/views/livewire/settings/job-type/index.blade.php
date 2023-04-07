<div>
    @if($browseMode)
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">Job Type</h3>
                <div class="float-right">
                    <button wire:click="create()" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                </div>
            </div>
            <div class="card-body">
                @livewire('staffmanagement::settings.data-tables.job-type-table')
            </div>
        </div>

    @elseif ($createMode||$editMode)
        @include('staffmanagement::livewire.settings.job-type.create')
    @endif
</div>
