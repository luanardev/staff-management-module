<div>
    @if($browseMode)
        <div class="card card-outline">
            <div class="card-header">
                <h3 class="card-title text-bold">Qualifications</h3>
                <div class="float-right">
                    <button wire:click="create()" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus-circle"></i> Add
                    </button>
                </div>
            </div>
            <div class="card-body ">
                @if($staff->qualifications->count())
                    <div class="row">
                        @foreach($staff->qualifications()->orderBy('year','desc')->get() as $qualification)
                            <div class="col-lg-12">

                                <div class="card card-widget widget-user-2">
                                    <div class="card-header">
                                        <div class="float-left">
                                            <button wire:click="edit('{{$qualification->id}}')" class="btn">Update
                                            </button>
                                            <button wire:click="download('{{$qualification->id}}')" class="btn">
                                                Download
                                            </button>
                                        </div>
                                        <div class="float-right">
                                            <button wire:click="delete('{{$qualification->id}}')" class="btn">Delete
                                            </button>
                                        </div>
                                    </div>

                                    <div class="widget-user-header ">

                                        <div class="widget-user-image">
                                            <img class="elevetion-2" src="{{ asset('img/qualification.png') }}"/>
                                        </div>

                                        <h4 class="widget-user-username">{{$qualification->name}}</h4>
                                        <h5 class="widget-user-desc">{{$qualification->getLevel()}}</h5>
                                    </div>

                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column">

                                            <li class="list-group-item">
                                                <span>Awarding Institution</span>
                                                <a class="float-right">
                                                    <span
                                                        class="text-bold text-sm">{{$qualification->institution}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Class Awarded</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$qualification->class}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Year Awarded</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$qualification->year}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Specialization</span>
                                                <a class="float-right">
                                                    <span
                                                        class="text-bold text-sm">{{$qualification->specialization}}</span>
                                                </a>
                                            </li>

                                            <li class="list-group-item">
                                                <span>Country</span>
                                                <a class="float-right">
                                                    <span class="text-bold text-sm">{{$qualification->country}}</span>
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
                                <h6>No Qualification Found</h6>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    @endif

    @if ($createMode||$editMode)
        @include('staffmanagement::livewire.profile.qualification.update')
    @endif
</div>
