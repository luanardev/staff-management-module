<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Qualification</h3>
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
                                <label class="control-label">Qualification *</label>
                                <input type="text" wire:model.lazy="qualification.name" name="name"
                                       class="form-control @error('qualification.name') is-invalid @enderror"
                                       placeholder="Enter Qualification Name"/>
                                @error('qualification.name')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Specialization </label>
                                <input type="text" wire:model.lazy="qualification.specialization" name="specialization"
                                       class="form-control @error('qualification.specialization') is-invalid @enderror"
                                       placeholder="Enter Specialization"/>
                                @error('qualification.specialization')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="control-label">Qualification Level *</label>
                                <select wire:model.lazy="qualification.level_id" name="level"
                                        class="form-control select3 @error('qualification.level') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('level') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('qualification.level')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Class Awarded </label>
                                <select wire:model.lazy="qualification.class" name="class"
                                        class="form-control @error('qualification.class') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('class') as $case)
                                        <option value="{{$case}}">{{$case}}</option>
                                    @endforeach
                                </select>
                                @error('qualification.class')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Awarding Institution *</label>
                                <input type="text" wire:model.lazy="qualification.institution" name="institution"
                                       class="form-control @error('qualification.institution') is-invalid @enderror"
                                       placeholder="Enter Awarding Institution"/>
                                @error('qualification.institution')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Year Awarded *</label>
                                <input type="year" wire:model.lazy="qualification.year" name="year"
                                       class="form-control @error('qualification.year') is-invalid @enderror"
                                       placeholder="Enter Year"/>
                                @error('qualification.year')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Country *</label>
                                <select wire:model.lazy="qualification.country" name="country"
                                        class="form-control select3 @error('qualification.country') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('country') as $case)
                                        <option value="{{$case}}">{{$case}}</option>
                                    @endforeach
                                </select>
                                @error('qualification.country')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


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

            </div>

        </div>
    </form>
</div>
