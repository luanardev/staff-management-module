<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Employment</h3>
        <div class="float-right">
            <div class="mb-3 mb-md-0">
                @can('update-staff')
                    <div class="dropdown d-block d-md-inline">
                        <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Actions
                        </button>

                        <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="actions">
                            <a href="#" wire:click.prevent="edit()" class="dropdown-item">
                                Update
                            </a>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="card-body">


        <div class="row">
            <div class="col-lg-12">

                <div class="card card-widget widget-user-2">

                    <div class="widget-user-header ">
                        <div class="widget-user-image">
                            <img class="elevetion-2" src="{{ asset('img/job.png') }}"/>
                        </div>

                        <h4 class="widget-user-username">{{$staff->employment->getPosition() }}</h4>
                        <h5 class="widget-user-desc">{{$staff->employment->getProgressDescription()}}</h5>
                    </div>

                    <div class="card-footer p-0">

                        <ul class="nav flex-column">

                            <li class="list-group-item">
                                <span>Job Category</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getJobCategory() }}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Job Ranking</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getJobRank() }}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Job Grade</span>
                                <a class="float-right">
                                    <span class="text-bold">{{ $staff->employment->getGradeScale() }}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Starting Date</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->startDate()}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Ending Date</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->endDate()}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Period of Service</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->elapsedPeriod()}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Campus</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getCampus() }}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Department</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getDepartment() }}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Section</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getSection() }}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Appointment Type</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->employment->getJobType() }}</span>
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

        </div>

    </div>
</div>
