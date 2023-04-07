<div>
    @if($browseMode)
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">Job Grade</h3>
                <div class="float-right">
                    <button wire:click="create()" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                </div>
            </div>
            <div class="card-body">
                @livewire('staffmanagement::settings.data-tables.job-grade-table')
            </div>
        </div>
    @endif

    @if ($createMode||$editMode)
        @include('staffmanagement::livewire.settings.job-grade.create')
    @endif
</div>
