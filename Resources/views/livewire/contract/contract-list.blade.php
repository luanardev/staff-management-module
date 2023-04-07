<div>

    <div class="card card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6">
                    <form wire:submit.prevent="search" class="form-horizontal">
                        <div class="input-group form-inline">
                            <input wire:model="searchTerm" type="text" class="form-control form-control-lg"
                                   placeholder="Search By ID or Name">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6">
                    <div class="float-right">

                        <a href="" class="btn btn-outline-primary">
                            <i class="fa fa-refresh"></i> Refresh
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($contractList->count())
                <div class="row">
                    @foreach($contractList as $staff)
                        <div class="col-lg-4">

                            <div class="card card-widget widget-user-2">
                                <div class="card-header">
                                    @if($staff->isTerminated())
                                        <div class="float-left">
                                            <a href="{{route('contract.create', $staff)}}"
                                               class="btn btn-sm btn-outline-success">
                                                Extend Contract
                                            </a>
                                        </div>
                                    @else
                                        <div class="float-right">
                                            <a wire:click="terminate('{{$staff->id}}')"
                                               class="btn btn-sm btn-outline-danger">
                                                Terminate Contract
                                            </a>
                                        </div>
                                    @endif
                                </div>

                                <div class="widget-user-header">
                                    <div class="widget-user-image">
                                        <img class="elevetion-2" src="{{ asset('img/user.png') }}"/>
                                    </div>

                                    <h4 class="widget-user-username">{{$staff->fullname}} ({{$staff->employee_number}}
                                        )</h4>
                                    <h5 class="widget-user-desc">{{$staff->position}}</h5>
                                </div>

                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <li class="list-group-item">
                                            <span>Department</span>
                                            <a class="float-right">
										<span class="text-bold text-sm">
										{{$staff->department}}
										</span>
                                            </a>
                                        </li>

                                        <li class="list-group-item">
                                            <span>Section/Unit</span>
                                            <a class="float-right">
										<span class="text-bold text-sm">
										{{$staff->section}}
										</span>
                                            </a>
                                        </li>

                                        <li class="list-group-item">
                                            <span>Appointment Date</span>
                                            <a class="float-right">
										<span class="text-bold text-sm">
										{{$staff->startDate()}}
										</span>
                                            </a>
                                        </li>

                                        <li class="list-group-item">
                                            <span>Termination Date</span>
                                            <a class="float-right">
										<span class="text-bold text-sm">
										{{$staff->endDate()}}
										</span>
                                            </a>
                                        </li>

                                        <li class="list-group-item">
                                            <span>Contract Period</span>
                                            <a class="float-right">
										<span class="text-bold text-sm">
											{{$staff->elapsedPeriod()}}
										</span>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Contract Status</span>
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
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col-lg-12">
                        <h5>Contract Staff Not Found</h5>
                    </div>
                </div>
            @endif
        </div>


    </div>


</div>
