<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Supervisor</h3>
        <div class="float-right">
            <button wire:click="create()" class=" btn btn-sm btn-primary">
                <i class="fas fa-plus-circle"></i> Add
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($supervisor->employee_number))
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    @if(!is_null($supervisor->avatar))
                                        <img src="{{ asset("storage/".$supervisor->avatar) }}" class="img-fluid"
                                             style="max-height: 100px;"/>
                                    @else
                                        <img src="{{ asset('img/default.png') }}" class="img-fluid"
                                             style="max-height: 100px;"/>
                                    @endif
                                </div>
                                <div class="col px-4">
                                    <h5>{{$supervisor->fullname()}} ({{$supervisor->employee_number}})</h5>
                                    <h6 class="mb-1 text-muted">{{$supervisor->getPosition()}}</h6>
                                    <h6 class="mb-1 text-muted">{{$supervisor->getCampus()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="callout callout-info">
                        <h6>No Supervisor Assigned</h6>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="float-left">
            <a href="Javascript:history.go(-1)" class="btn btn-secondary">
                Previous
            </a>
        </div>
        <div class="float-right">
            <a href="{{route($nextRoute)}}" class="btn btn-primary">
                Next
            </a>
        </div>
    </div>
</div>
