<div>
    <div class="card card-outline">

        <form wire:submit.prevent="save">

            <div class="card-header">
                <h3 class="card-title text-bold">Next of Kin</h3>
                <div class="float-right">

                    <button type="button" wire:click="copySpouse()" class=" btn btn-sm btn-primary">
                        <i class="fas fa-user"></i> Spouse
                    </button>

                    <button type="button" wire:click="resetForm()" class=" btn btn-sm btn-secondary">
                        <i class="fas fa-times-circle"></i> Reset Form
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
                                    <select wire:model.lazy="kinsman.title" name="title"
                                            class="form-control select3 @error('kinsman.title') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('title') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('kinsman.title')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">First Name *</label>
                                    <input type="text" wire:model.lazy="kinsman.firstname" name="firstname"
                                           class="form-control @error('kinsman.firstname') is-invalid @enderror"
                                           placeholder="Enter First Name"/>
                                    @error('kinsman.firstname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Last Name *</label>
                                    <input type="text" wire:model.lazy="kinsman.lastname" name="lastname"
                                           class="form-control @error('kinsman.lastname') is-invalid @enderror"
                                           placeholder="Enter Last Name"/>
                                    @error('kinsman.lastname')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Relation *</label>
                                    <select wire:model.lazy="kinsman.relation" name="relation"
                                            class="form-control select3 @error('kinsman.relation') is-invalid @enderror">
                                        <option value="">--select--</option>
                                        @foreach ($viewBag->get('relation') as $case)
                                            <option value="{{$case}}">{{$case}}</option>
                                        @endforeach
                                    </select>
                                    @error('kinsman.relation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Occupation</label>
                                    <input type="text" wire:model.lazy="kinsman.occupation" name="occupation"
                                           class="form-control @error('kinsman.occupation') is-invalid @enderror"
                                           placeholder="Enter Occupation "/>
                                    @error('kinsman.occupation')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Organization</label>
                                    <input type="text" wire:model.lazy="kinsman.organization" name="organization"
                                           class="form-control @error('kinsman.organization') is-invalid @enderror"
                                           placeholder="Enter Organization"/>
                                    @error('kinsman.organization')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Email *</label>
                                    <input type="email" wire:model.lazy="kinsman.contact_email" name="contact_email"
                                           class="form-control @error('kinsman.contact_email') is-invalid @enderror"
                                           placeholder="Enter Contact Email"/>
                                    @error('kinsman.contact_email')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Contact Number *</label>
                                    <input type="tel" wire:model.lazy="kinsman.contact_number" name="contact_number"
                                           class="form-control @error('kinsman.contact_number') is-invalid @enderror"
                                           placeholder="Enter Contact Number">
                                    @error('kinsman.contact_number')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Contact Address *</label>
                                    <textarea wire:model.lazy="kinsman.contact_address" name="contact_address"
                                              class="form-control @error('kinsman.contact_address') is-invalid @enderror"
                                              placeholder="Enter Contact Address"></textarea>
                                    @error('kinsman.contact_address')
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
                    <a href="Javascript:history.go(-1)" class="btn btn-secondary float-left">
                        Previous
                    </a>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary">
                        Next
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>





