<div>
    <div class="card card-outline">
        <x-adminlte-validation/>
        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">Personal Information</h3>
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
                                    <label class="control-label">National ID </label>
                                    <input type="text" wire:model.lazy="staff.national_id" name="national_id"
                                           class="form-control @error('staff.national_id') is-invalid @enderror"
                                           placeholder="Enter National ID"/>
                                    @error('staff.national_id')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Title *</label>
                                    <select wire:model.lazy="staff.title" name="title"
                                            class="form-control select3 @error('staff.title') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('title') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('staff.title')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">First Name *</label>
                                    <input type="text" wire:model.lazy="staff.firstname" name="firstname"
                                           class="form-control @error('staff.firstname') is-invalid @enderror"
                                           placeholder="Enter First Name"/>
                                    @error('staff.firstname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name *</label>
                                    <input type="text" wire:model.lazy="staff.lastname" name="lastname"
                                           class="form-control @error('staff.lastname') is-invalid @enderror"
                                           placeholder="Enter Last Name"/>
                                    @error('staff.lastname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Middle Name</label>
                                    <input type="text" wire:model.lazy="staff.middlename" name="middlename"
                                           class="form-control @error('staff.middlename') is-invalid @enderror "
                                           placeholder="Enter Middle Name">
                                    @error('staff.middlename')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Maiden Name</label>
                                    <input type="text" wire:model.lazy="staff.maidenname" name="maidenname"
                                           class="form-control @error('staff.maidenname') is-invalid @enderror "
                                           placeholder="Enter Maiden Name">
                                    @error('staff.maidenname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Date of Birth *</label>
                                    <input type="date" wire:model.lazy="staff.date_of_birth" name="date_of_birth"
                                           class="form-control @error('staff.date_of_birth') is-invalid @enderror"/>
                                    @error('staff.date_of_birth')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Gender *</label>
                                    <select wire:model.lazy="staff.gender" name="gender"
                                            class="form-control select3 @error('staff.gender') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('gender') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('staff.gender')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Marital Status *</label>
                                    <select wire:model.lazy="staff.marital_status" name="marital_status"
                                            class="form-control select3 @error('staff.marital_status') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('maritalStatus') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('staff.marital_status')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Personal Email *</label>
                                    <input type="email" wire:model.lazy="staff.personal_email" name="personal_email"
                                           class="form-control @error('staff.personal_email') is-invalid @enderror "
                                           placeholder="Enter Personal Email"/>
                                    @error('staff.personal_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Mobile Contact *</label>
                                    <input type="text" wire:model.lazy="staff.mobile_contact" name="mobile_contact"
                                           class="form-control @error('staff.mobile_contact') is-invalid @enderror"
                                           placeholder="Enter Mobile Contact"/>
                                    @error('staff.mobile_contact')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Home Contact</label>
                                    <input type="text" wire:model.lazy="staff.home_contact" name="home_contact"
                                           class="form-control @error('staff.home_contact') is-invalid @enderror"
                                           placeholder="Enter Home Contact">
                                    @error('staff.home_contact')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Contact Address *</label>
                                    <textarea wire:model.lazy="staff.contact_address" name="contact_address"
                                              class="form-control @error('staff.contact_address') is-invalid @enderror"
                                              placeholder="Enter Contact Address"></textarea>
                                    @error('staff.contact_address')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home Village</label>
                                    <input type="text" wire:model.lazy="staff.home_village" name="home_village"
                                           class="form-control @error('staff.home_village') is-invalid @enderror"
                                           placeholder="Enter Home Village">
                                    @error('staff.home_village')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home T/A</label>
                                    <input type="text" wire:model.lazy="staff.home_authority" name="home_ta"
                                           class="form-control @error('staff.home_authority') is-invalid @enderror "
                                           placeholder="Enter Home Authority">
                                    @error('staff.home_authority')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home District</label>
                                    <select wire:model.lazy="staff.home_district" name="home_district"
                                            class="form-control select3 @error('staff.home_district') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('district') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('staff.home_district')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Home Country</label>
                                    <select wire:model.lazy="staff.home_country" name="home_country"
                                            class="form-control select3 @error('staff.home_country') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('country') as $country)
                                            <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                    @error('staff.home_country')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
    </div>
</div>
</div>





