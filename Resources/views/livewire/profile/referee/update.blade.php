<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Referees</h3>
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
                    <div class="callout callout-info">
                        <p>Please note that referees are strictly academic or professional</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Title *</label>
                                <select wire:model.lazy="referee.title"
                                        class="form-control select3 @error('referee.title') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('title') as $name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('referee.title')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">First Name *</label>
                                <input type="text" wire:model.lazy="referee.firstname" name="firstname"
                                       class="form-control @error('referee.firstname') is-invalid @enderror"
                                       placeholder="Enter Firstname"/>
                                @error('referee.firstname')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Last Name *</label>
                                <input type="text" wire:model.lazy="referee.lastname" name="lastname"
                                       class="form-control @error('referee.lastname') is-invalid @enderror"
                                       placeholder="Enter Lastname"/>
                                @error('referee.lastname')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Relation *</label>
                                <input type="text" wire:model.lazy="referee.relation" name="relation"
                                       class="form-control @error('referee.relation') is-invalid @enderror"
                                       placeholder="Enter Relation"/>
                                @error('referee.relation')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Organization *</label>
                                <input type="text" wire:model.lazy="referee.organization" name="organization"
                                       class="form-control @error('referee.organization') is-invalid @enderror"
                                       placeholder="Enter Organization"/>
                                @error('referee.organization')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Contact Email *</label>
                                <input type="text" wire:model.lazy="referee.contact_email" name="contact_email"
                                       class="form-control @error('referee.contact_email') is-invalid @enderror"
                                       placeholder="Enter Contact Email"/>
                                @error('referee.contact_email')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Contact Number *</label>
                                <input type="tel" wire:model.lazy="referee.contact_number" name="contact_number"
                                       class="form-control @error('referee.contact_number') is-invalid @enderror"
                                       placeholder="Enter Contact Number"/>
                                @error('referee.contact_number')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="control-label">Contact Address *</label>
                                <textarea wire:model.lazy="referee.contact_address" name="contact_address"
                                          class="form-control @error('referee.contact_address') is-invalid @enderror"
                                          placeholder="Enter Contact Address"></textarea>
                                @error('referee.contact_address')
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
