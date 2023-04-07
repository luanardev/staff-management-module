<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Employment Information</h3>

    </div>

    <div class="card-body">


        <div class="row">
            <div class="col-lg-5">

                <div class="card card-widget widget-user-2">

                    <div class="widget-user-header ">
                        <livewire:staffmanagement::profile.avatar :staff=$staff />
                        <h4 class="widget-user-username">{{$staff->fullname()}} ({{$staff->employee_number}})</h4>
                        <h5 class="widget-user-desc">{{$staff->employment->getPosition()}}</h5>
                    </div>

                    <div class="card-footer p-0">

                        <ul class="nav flex-column">
                            <li class="list-group-item">
                                <span>Department</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
									{{$staff->employment->getDepartment()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Section/Unit</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
									{{$staff->employment->getSection()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Appointment Type</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
										{{$staff->employment->getProgressType()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Appointment Date</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
									{{$staff->employment->startDate()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Period of Service</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
										{{$staff->employment->elapsedPeriod()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Appointment Status</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
										{!! $staff->employment->statusBadge() !!}
									</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">

                <form wire:submit.prevent="save">
                    <div class="card card-outline">
                        <div class="card-header">
                            <h3 class="card-title text-bold">Update Employment Status</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Status *</label>
                                        <select wire:model="employment.job_status_id"
                                                class="form-control select3 @error('employment.job_status_id') is-invalid @enderror">
                                            <option value="">--select--</option>
                                            @foreach ($viewBag->get('status') as $id => $name)
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
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-left">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </form>

            </div>

        </div>


    </div>

</div>






