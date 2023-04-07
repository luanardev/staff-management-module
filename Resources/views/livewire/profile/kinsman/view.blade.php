<div class="card card-outline">
    <div class="card-header ">
        <h3 class="card-title text-bold">Next of Kin</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>

                    <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="actions">
                        @if($staff->hasKinsman())
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
                            <a href="#" wire:click.prevent="copySpouse()" class="dropdown-item">
                                Copy Spouse
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

                        <h4 class="widget-user-username">{{$staff->kinsman->fullname()}}</h4>
                        <h5 class="widget-user-desc">{{$staff->kinsman->relation}}</h5>
                    </div>

                    <div class="card-footer p-0">


                        <ul class="nav flex-column">

                            <li class="list-group-item">
                                <span>Contact Email</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->kinsman->contact_email}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Contact Number</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->kinsman->contact_number}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Contact Address</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->kinsman->contact_address}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Occupation</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->kinsman->occupation}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span>Organization</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->kinsman->organization}}</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
