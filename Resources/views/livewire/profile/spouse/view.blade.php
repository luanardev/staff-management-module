<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Spouse Information</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>

                    <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="actions">
                        @if($staff->hasSpouse())
                            <a href="#" wire:click.prevent="edit()" class="dropdown-item">
                                Update
                            </a>
                            <a href="#" wire:click.prevent="delete()" class="dropdown-item">
                                Delete
                            </a>
                        @else
                            <a href="#" wire:click.prevent="create()" class="dropdown-item">
                                Create
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="card-body">

        <div class="row">
            <div class="col-lg-12">

                <div class="card card-widget widget-user-2">

                    <div class="widget-user-header ">
                        <div class="widget-user-image">
                            <img class="elevetion-2" src="{{ asset('img/user.png') }}"/>
                        </div>

                        <h4 class="widget-user-username">{{$staff->spouse->name()}}</h4>
                        <h5 class="widget-user-desc">{{$staff->spouse->title}}</h5>
                    </div>

                    <div class="card-footer p-0">

                        <ul class="nav flex-column">

                            <li class="list-group-item">
                                <span>Gender</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->gender}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span>Date of Birth</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->dateOfBirth()}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Contact Email</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->contact_email}}</span><br/>

                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Contact Number</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->contact_number}}</span><br/>

                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Contact Address</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->contact_address}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Home Country</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->spouse->home_country}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Home Village</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->spouse->home_village }}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Home T/A</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->spouse->home_authority }}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Home District</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->spouse->home_district }}
									</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
