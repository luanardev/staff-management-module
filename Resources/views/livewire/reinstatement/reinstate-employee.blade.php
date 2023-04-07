<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Reinstate Staff</h3>
        <div class="float-right">
            <a href="{{route('reinstatement.index')}}" class="btn btn-outline-primary">
                New Reinstatement
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
                                <span>Period of Service</span>
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

                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-left">
                                    <button type="button" wire:click="reinstate" class="btn btn-success">Reinstate
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
