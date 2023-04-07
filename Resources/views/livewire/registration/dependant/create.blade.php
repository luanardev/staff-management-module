<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Dependants</h3>
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
                    <div class="callout callout-info">
                        <p>Please note that biological and adopted children should not exceed 21 years of age</p>
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Title *</label>
                                <select wire:model.lazy="dependant.title"
                                        class="form-control select3 @error('dependant.title') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('title') as $name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('dependant.title')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">First Name *</label>
                                <input type="text" wire:model.lazy="dependant.firstname"
                                       class="form-control @error('dependant.firstname') is-invalid @enderror"
                                       placeholder="Enter Firstname"/>
                                @error('dependant.firstname')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Last Name *</label>
                                <input type="text" wire:model.lazy="dependant.lastname"
                                       class="form-control @error('dependant.lastname') is-invalid @enderror"
                                       placeholder="Enter Lastname"/>
                                @error('dependant.lastname')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Relation *</label>
                                <select wire:model.lazy="dependant.relation"
                                        class="form-control select3 @error('dependant.relation') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('relation') as $name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('dependant.relation')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Gender *</label>
                                <select wire:model.lazy="dependant.gender"
                                        class="form-control select3 @error('dependant.gender') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('gender') as $name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('dependant.gender')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Date of Birth *</label>
                                <input type="date" wire:model.lazy="dependant.date_of_birth"
                                       class="form-control @error('dependant.date_of_birth') is-invalid @enderror"
                                       placeholder="Enter Date of birth"/>
                                @error('dependant.date_of_birth')
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
