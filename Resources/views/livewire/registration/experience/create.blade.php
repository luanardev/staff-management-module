<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Work Experience</h3>
            <div class="float-right">
                <button type="submit" class=" btn btn-sm btn-primary">
                    <i class="fas fa-check-circle"></i> Save
                </button>
                <button type="button" wire:click="cancel" class=" btn btn-sm btn-secondary">
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
                                <label class="control-label">Position *</label>
                                <input type="text" wire:model.lazy="experience.position" name="position"
                                       class="form-control @error('experience.position') is-invalid @enderror"
                                       placeholder="Enter Job Position"/>
                                @error('experience.position')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Organization * </label>
                                <input type="text" wire:model.lazy="experience.organization" name="organization"
                                       class="form-control @error('experience.organization') is-invalid @enderror"
                                       placeholder="Enter Organization"/>
                                @error('experience.organization')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Contact Email * </label>
                                <input type="email" wire:model.lazy="experience.contact_email" name="contact_email"
                                       class="form-control @error('experience.contact_email') is-invalid @enderror"
                                       placeholder="Enter Contact Email"/>
                                @error('experience.contact_email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Contact Number * </label>
                                <input type="tel" wire:model.lazy="experience.contact_number" name="contact_number"
                                       class="form-control @error('experience.contact_number') is-invalid @enderror"
                                       placeholder="Enter Contact Number"/>
                                @error('experience.contact_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Contact Address * </label>
                                <textarea wire:model.lazy="experience.contact_address" name="contact_address"
                                          class="form-control @error('experience.contact_address') is-invalid @enderror "
                                          placeholder="Enter Contact Address"></textarea>
                                @error('experience.contact_address')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Start Date *</label>
                                <input type="date" wire:model="experience.start_date"
                                       class="form-control @error('experience.start_date') is-invalid @enderror "/>
                                @error('experience.start_date')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">End Date *</label>
                                <input type="date" wire:model="experience.end_date"
                                       class="form-control @error('experience.end_date') is-invalid @enderror"/>
                                @error('experience.end_date')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <div class="float-left">
                <a href="Javascript:history.go(-1)" class="btn btn-secondary">
                    Previous
                </a>
            </div>
            <div class="float-right">
                <a href="{{route($nextRoute)}}" class="btn btn-primary">
                    Next
                </a>
            </div>
        </div>
    </form>
</div>
