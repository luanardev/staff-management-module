<div>
    @if($browseMode)
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">Referees</h3>
                <div class="float-right">
                    <button wire:click="create()" class=" btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Add
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if($staff->referees->count())
                    <div class="row">
                        @foreach($staff->referees as $referee)
                            <div class="col-lg-12">

                                <div class="card card-widget widget-user-2">
                                    <div class="card-header">
                                        <div class="float-left">
                                            <button wire:click="edit('{{$referee->id}}')" class="btn">Update</button>
                                        </div>
                                        <div class="float-right">
                                            <button wire:click="delete('{{$referee->id}}')" class="btn">Delete</button>
                                        </div>
                                    </div>

                                    <div class="widget-user-header ">
                                        <div class="widget-user-image">
                                            <img class="elevetion-2" src="{{ asset('img/user.png') }}"/>
                                        </div>

                                        <h4 class="widget-user-username">{{$referee->fullname()}}</h4>
                                        <h5 class="widget-user-desc">{{$referee->relation}}</h5>
                                    </div>

                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column">

                                            <li class="list-group-item">
                                                <span>Organization</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$referee->organization}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Email</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$referee->contact_email}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Number</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$referee->contact_number}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Address</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$referee->contact_address}}</span>
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
                                <h6>No Reference Found</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if ($createMode||$editMode)
        @include('staffmanagement::livewire.profile.referee.update')
    @endif
</div>
