<div class="card card-outline">

    <form wire:submit.prevent="save">
        <div class="card-header">
            <h3 class="card-title text-bold">Employment</h3>

        </div>
        <div class="card-body">

            <div class="row">

                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Position *</label>
                                <select wire:model.lazy="employment.position_id"
                                        class="form-control select3 @error('employment.position_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('positions') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.position_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Tenure *</label>
                                <select wire:model.lazy="employment.job_type_id"
                                        class="form-control select3 @error('employment.job_type_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('types') as $id =>  $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.job_type_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Category *</label>
                                <select wire:model.lazy="employment.job_category_id"
                                        class="form-control select3 @error('employment.job_category_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('categories') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.job_category_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="form-group">
                                <label class="control-label">Ranking </label>
                                <select wire:model.lazy="employment.job_rank_id"
                                        class="form-control select3 @error('employment.job_rank_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($this->ranks() as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.job_rank_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Grade *</label>
                                <select wire:model.lazy="employment.grade"
                                        class="form-control select3 @error('employment.grade') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('grades') as $name)
                                        <option value="{{$name}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.grade')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Notch </label>
                                <select wire:model.lazy="employment.notch"
                                        class="form-control select3 @error('employment.notch') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($this->notches() as $notch)
                                        <option value="{{$notch}}">{{$notch}}</option>
                                    @endforeach
                                </select>
                                @error('employment.notch')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Starting Date *</label>
                                <input type="date" wire:model.lazy="employment.start_date" name="start_date"
                                       class="form-control @error('employment.start_date') is-invalid @enderror "
                                       placeholder="Enter date">
                                @error('employment.start_date')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Ending Date</label>
                                <input type="date" wire:model.lazy="employment.end_date" name="end_date"
                                       class="form-control @error('employment.end_date') is-invalid @enderror"
                                       placeholder="Enter date">
                                @error('employment.end_date')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Campus *</label>
                                <select wire:model.lazy="employment.campus_id"
                                        class="form-control select3 @error('employment.campus_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('campuses') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.campus_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Department *</label>
                                <select wire:model.lazy="employment.department_id"
                                        class="form-control select3 @error('employment.department_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('departments') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.department_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Section *</label>
                                <select wire:model.lazy="employment.section_id"
                                        class="form-control select3 @error('employment.section_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('sections') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.section_id')
                                <span class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label">Status *</label>
                                <select wire:model.lazy="employment.job_status_id"
                                        class="form-control select3 @error('employment.job_status_id') is-invalid @enderror">
                                    <option value="">--select--</option>
                                    @foreach ($viewBag->get('statuses') as $id => $name)
                                        <option value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                                @error('employment.job_status_id')
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


