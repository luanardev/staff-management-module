<div>
    @if($browseMode)
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">Work Experience</h3>
                <div class="float-right">
                    <button wire:click="create()" class=" btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Add
                    </button>
                </div>
            </div>
            <div class="card-body ">
                @if($staff->experience->count())
                    <div class="row">
                        @foreach($staff->experience()->latest()->get() as $experience)
                            <div class="col-lg-12">

                                <div class="card card-widget widget-user-2">

                                    <div class="card-header">
                                        <div class="float-left">
                                            <button wire:click="edit('{{$experience->id}}')" class="btn">Update</button>
                                        </div>
                                        <div class="float-right">
                                            <button wire:click="delete('{{$experience->id}}')" class="btn">Delete
                                            </button>
                                        </div>
                                    </div>

                                    <div class="widget-user-header ">
                                        <div class="widget-user-image">
                                            <img class="elevetion-2" src="{{ asset('img/job.png') }}"/>
                                        </div>

                                        <h4 class="widget-user-username">{{$experience->position}}</h4>
                                        <h5 class="widget-user-desc">{{$experience->organization}}</h5>
                                    </div>

                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column">

                                            <li class="list-group-item">
                                                <span>Started On</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$experience->startDate()}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Ended On</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$experience->endDate()}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Work Period</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$experience->period()}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Email</span>
                                                <a class="float-right">
                                                    <span
                                                        class="text-bold text-sm">{{$experience->contact_email}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Number</span>
                                                <a class="float-right">
                                                    <span
                                                        class="text-bold text-sm">{{$experience->contact_number}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Contact Address</span>
                                                <a class="float-right">
                                                    <span
                                                        class="text-bold text-sm">{{$experience->contact_address}}</span>
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
                                <h6>No Work Experience Found</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    @if ($createMode||$editMode)
        @include('staffmanagement::livewire.profile.experience.update')
    @endif
</div>
