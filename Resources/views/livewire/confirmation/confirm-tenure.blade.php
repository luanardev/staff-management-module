<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Confirm Tenure</h3>
        <div class="float-right">
            <a href="{{route('confirmation.index')}}" class="btn btn-outline-primary">
                New Confirmation
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
                                <span>Appointment Date</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
									{{$staff->employment->startDate()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Probation End Date</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
									{{$staff->employment->endDate()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Probation Period</span>
                                <a class="float-right">
									<span class="text-bold text-sm">
										{{$staff->employment->elapsedPeriod()}}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Appointment Status</span>
                                <div class="float-right">
                                    <span class="text-bold">{!! $staff->employment->statusBadge() !!}</span>
                                </div>
                            </li>

                            <li class="list-group-item">
                                <span>Confirmation Status</span>
                                <div class="float-right">
                                    <span class="text-bold">{!! $staff->employment->confirmationBadge() !!}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <!--<form wire:submit.prevent="confirm">-->
                <div class="card card-outline">
                    <div class="card-header">
                        <h3 class="card-title text-bold">Confirmation Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Confirmation Comment *</label>
                                    <textarea rows="4" wire:model="confirmationComment" name="comment"
                                              class="form-control @error('confirmationComment') is-invalid @enderror"
                                              placeholder="Enter Comment"></textarea>
                                    @error('confirmationComment')
                                    <span class="error invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="control-label">Confirmation Date *</label>
                                    <input type="date" wire:model="confirmationDate" name="confirmDate"
                                           class="form-control @error('confirmationDate') is-invalid @enderror"
                                           placeholder="Enter Confirmation Date"/>
                                    @error('confirmationDate')
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
                                    <button type="button" wire:click="confirm" class="btn btn-success">Confirm</button>
                                </div>
                                <div class="float-right">
                                    <button type="button" wire:click="dismiss" class="btn btn-danger">Dismiss</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--</form>	-->
            </div>

        </div>

    </div>

</div>
