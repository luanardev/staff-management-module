<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Academic Award</h3>
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

                <div class="col-lg-12">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Award Name *</label>
                                <input type="text" wire:model.lazy="award.name" name="award"
                                       class="form-control @error('award.name') is-invalid @enderror"
                                       placeholder="Enter Award Name"/>
                                @error('award.name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Institution *</label>
                                <input type="text" wire:model.lazy="award.institution" name="institution"
                                       class="form-control @error('award.institution') is-invalid @enderror"
                                       placeholder="Enter Awarding Institution"/>
                                @error('award.institution')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Country *</label>
                                <select wire:model.lazy="award.country" name="country"
                                        class="form-control select3 @error('award.country') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('country') as $case)
                                        <option value="{{$case}}">{{$case}}</option>
                                    @endforeach
                                </select>
                                @error('award.country')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Award Year *</label>
                                <input type="year" wire:model.lazy="award.year" name="year"
                                       class="form-control @error('award.year') is-invalid @enderror"
                                       placeholder="Enter Year"/>
                                @error('award.year')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
