<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title">Appoint Staff Member</h3>
        <div class="float-right">
            <a href="{{route('headship.search')}}" class="btn btn-outline-primary">
                New Appointment
            </a>
        </div>
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
                            <h3 class="card-title">Appointment Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="control-label">Position *</label>
                                        <select wire:model="position"
                                                class="form-control select3 @error('position') is-invalid @enderror">
                                            <option value="">--select--</option>
                                            @foreach ($viewBag->get('position') as $key => $value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('position')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Department *</label>
                                        <select wire:model="department"
                                                class="form-control select3  @error('department') is-invalid @enderror">
                                            <option value="">--select--</option>
                                            @foreach ($viewBag->get('department') as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Campus *</label>
                                        <select wire:model="campus"
                                                class="form-control select3  @error('campus') is-invalid @enderror">
                                            <option value="">--select--</option>
                                            @foreach ($viewBag->get('campus') as $id => $name)
                                                <option value="{{$id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                        @error('campus')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">Start Date *</label>
                                        <input type="date" wire:model="startdate"
                                               class="form-control @error('startdate') is-invalid @enderror"/>
                                        @error('rank')
                                        <span class="error invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="control-label">End Date *</label>
                                        <input type="date" wire:model="enddate"
                                               class="form-control @error('enddate') is-invalid @enderror "/>
                                        @error('enddate')
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






