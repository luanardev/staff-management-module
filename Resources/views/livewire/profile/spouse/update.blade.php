<div>
    <div class="card card-outline">

        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">Spouse Information</h3>
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
                                    <label class="control-label">Title *</label>
                                    <select wire:model.lazy="spouse.title" name="title"
                                            class="form-control select3 @error('spouse.title') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('title') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('spouse.title')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">National ID</label>
                                    <input type="text" wire:model.lazy="spouse.national_id" name="national_id"
                                           class="form-control @error('spouse.national_id') is-invalid @enderror"
                                           placeholder="Enter National ID"/>
                                    @error('spouse.national_id')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">First Name *</label>
                                    <input type="text" wire:model.lazy="spouse.firstname" name="firstname"
                                           class="form-control @error('spouse.firstname') is-invalid @enderror"
                                           placeholder="Enter First Name"/>
                                    @error('spouse.firstname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name *</label>
                                    <input type="text" wire:model.lazy="spouse.lastname" name="lastname"
                                           class="form-control @error('spouse.lastname') is-invalid @enderror"
                                           placeholder="Enter Last Name"/>
                                    @error('spouse.lastname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Gender *</label>
                                    <select wire:model.lazy="spouse.gender" name="gender"
                                            class="form-control select3 @error('spouse.gender') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('gender') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('spouse.gender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Date of Birth *</label>
                                    <input type="date" wire:model.lazy="spouse.date_of_birth" name="date_of_birth"
                                           class="form-control @error('spouse.date_of_birth') is-invalid @enderror"/>
                                    @error('spouse.date_of_birth')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Email *</label>
                                    <input type="tel" wire:model.lazy="spouse.contact_email" name="contact_email"
                                           class="form-control @error('spouse.contact_email') is-invalid @enderror"
                                           placeholder="Enter Contact Email"/>
                                    @error('spouse.contact_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number *</label>
                                    <input type="tel" wire:model.lazy="spouse.contact_number" name="contact_number"
                                           class="form-control @error('spouse.contact_number') is-invalid @enderror"
                                           placeholder="Enter Contact Number">
                                    @error('spouse.contact_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Contact Address *</label>
                                    <textarea wire:model.lazy="spouse.contact_address" name="contact_address"
                                              class="form-control @error('spouse.contact_address') is-invalid @enderror"
                                              placeholder="Enter Contact Address"></textarea>
                                    @error('spouse.contact_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home Village</label>
                                    <input type="text" wire:model.lazy="spouse.home_village" name="home_village"
                                           class="form-control @error('spouse.home_village') is-invalid @enderror"
                                           placeholder="Enter Home Village">
                                    @error('spouse.home_village')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home T/A</label>
                                    <input type="text" wire:model.lazy="spouse.home_authority" name="home_authority"
                                           class="form-control @error('spouse.home_authority') is-invalid @enderror"
                                           placeholder="Enter Home TA">
                                    @error('spouse.home_authority')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home District</label>
                                    <select wire:model.lazy="spouse.home_district" name="home_district"
                                            class="form-control select3 @error('spouse.home_district') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('district') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('spouse.home_district')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home Country</label>
                                    <select wire:model.lazy="spouse.home_country" name="home_country"
                                            class="form-control select3 @error('spouse.home_country') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('country') as $country)
                                            <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                    @error('spouse.home_country')
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
</div>





