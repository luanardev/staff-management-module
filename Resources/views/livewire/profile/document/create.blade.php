<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Document</h3>
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
                <button type="button" wire:click="show()" class="btn btn-sm btn-secondary">
                    <i class="fas fa-times-circle"></i> Cancel
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Document Name *</label>
                        <input type="text" wire:model="name" name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Enter Document Name"/>
                        @error('name')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Document Type *</label>
                        <select wire:model="documentType" name="documentType"
                                class="form-control select3 @error('documentType') is-invalid @enderror">
                            <option value="">--select--</option>
                            @foreach ($viewBag->get('documentType') as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                        @error('documentType')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="control-label">Attachment *</label>
                        <input type="file" wire:model="uploadedFile" name="uploadedFile"
                               class="form-control @error('uploadedFile') is-invalid @enderror"/>
                        @error('uploadedFile')
                        <span class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
