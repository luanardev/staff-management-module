<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Assign Supervisor</h3>
        <div class="float-right">
            <button wire:click="show" class="btn btn-sm btn-secondary">
                <i class="fas fa-times-circle"></i> Cancel
            </button>
        </div>

    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <form wire:submit.prevent="search">
                    <div class="input-group">
                        <input wire:model="searchTerm" type="text" class="form-control"
                               placeholder="Search Staff ID or Name">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br/>
        @if(isset($searchResults))
            <div class="row">
                @if(count($searchResults) > 0)
                    <div class="col-lg-12">
                        <div class="list-group">
                            @foreach($searchResults as $staff)

                                <div class="list-group-item">
                                    <div class="row">

                                        <div class="col-auto">
                                            @if(!is_null($staff->avatar))
                                                <img src="{{ asset("storage/".$staff->avatar) }}" class="img-fluid"
                                                     style="max-height: 100px;"/>
                                            @else
                                                <img src="{{ asset('img/default.png') }}" class="img-fluid"
                                                     style="max-height: 100px;"/>
                                            @endif
                                        </div>
                                        <div class="col px-4">
                                            <h5>{{$staff->fullname}} ({{$staff->employee_number}})</h5>
                                            <h6 class="mb-1">{{$staff->position}}</h6>
                                            <h6 class="mb-1">{{$staff->campus}}</h6>
                                            <button wire:click="assign('{{$staff->id}}')"
                                                    class="btn btn-sm btn-outline-primary">Add Supervisor
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Record not found
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>


</div>





