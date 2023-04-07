<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <form wire:submit.prevent="search">
                <div class="input-group">
                    <input wire:model="searchTerm" type="text" class="form-control form-control-lg"
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
                <div class="col-lg-8">
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
                                        <a href="{{route($route, $staff)}}">
                                            <div>
                                                <h5>{{$staff->fullname}} ({{$staff->employee_number}})</h5>
                                                <h6 class="mb-1">{{$staff->position}}</h6>
                                                <h6 class="mb-1">{{$staff->campus}}</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="col-lg-8">
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        Record not found
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>

