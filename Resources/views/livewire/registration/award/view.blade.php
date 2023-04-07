<div class="card card-outline">
    <div class="card-header">
        <h3 class="card-title text-bold">Academic Awards</h3>
        <div class="float-right">

            <button wire:click="create()" class=" btn btn-sm btn-primary">
                <i class="fas fa-plus-circle"></i> Add
            </button>

        </div>
    </div>
    <div class="card-body">
        @if($awards->count())
            <div class="row">
                @foreach($awards as $award)
                    <div class="col-lg-12">

                        <div class="card card-widget widget-user-2">
                            <div class="card-header">
                                <div class="float-left">
                                    <button wire:click="edit('{{$award->id}}')" class="btn">Update</button>
                                </div>
                                <div class="float-right">
                                    <button wire:click="delete('{{$award->id}}')" class="btn">Delete</button>
                                </div>
                            </div>

                            <div class="widget-user-header ">

                                <div class="widget-user-image">
                                    <img class="elevetion-2" src="{{ asset('img/award.png') }}"/>
                                </div>

                                <h4 class="widget-user-username">{{$award->name}}</h4>
                                <h5 class="widget-user-desc">{{$award->year}}</h5>

                            </div>

                            <div class="card-footer p-0">
                                <ul class="nav flex-column">

                                    <li class="list-group-item">
                                        <span>Institution</span>
                                        <a class="float-right">
                                            <span class="text-bold text-sm">{{$award->institution}}</span>
                                        </a>
                                    </li>

                                    <li class="list-group-item">
                                        <span>Country</span>
                                        <a class="float-right">
                                            <span class="text-bold text-sm">{{$award->country}}</span>
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
                    <div class="callout callout-info">
                        <h6>No Award Found</h6>
                    </div>
                </div>
            </div>
        @endif
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
