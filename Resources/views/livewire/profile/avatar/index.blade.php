<div>

    @if($browseMode)
        <a href="#" wire:click="create()">
            <div class="widget-user-image">
                @if(!is_null($staff->avatar))
                    <img class="img-fluid img-circle elevetion-2" src="{{ asset('storage/'.$staff->avatar) }}"/>
                @else
                    <img class="img-fluid img-circle elevetion-2" src="{{ asset('img/default.png') }}"/>
                @endif
            </div>
        </a>
    @endif

    @if($createMode)
        <x-adminlte-validation/>
        <form wire:submit.prevent="save">

            <div class="row">
                <div class="col-lg-3">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" wire:model="photo" class="custom-file-input" id="InputFile">
                            <label class="custom-file-label" for="InputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Upload
                            </button>
                            <button type="button" class="btn btn-sm btn-default" wire:click="show()">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
</div>
