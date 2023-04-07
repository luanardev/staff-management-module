<div class="card card-outline">

    <div class="card-header">
        <h3 class="card-title text-bold">Personal Information</h3>

        <div class="float-right">
            <div class="mb-3 mb-md-0">
                <div class="dropdown d-block d-md-inline">
                    <button class="btn dropdown-toggle d-block w-100 d-md-inline" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu dropdown-menu-right w-200" aria-labelledby="actions">
                        <a href="#" wire:click.prevent="edit()" class="dropdown-item">
                            Update
                        </a>
                        @can('update-staff')
                            <a href="{{route('identity.show', $staff)}}" class="dropdown-item">
                                ID Card
                            </a>
                        @endcan
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
                        <livewire:staffmanagement::profile.avatar :staff=$staff />
                        <h4 class="widget-user-username">{{$staff->fullname()}} ({{$staff->employee_number}})</h4>
                        <h5 class="widget-user-desc">{{$staff->getPosition()}}</h5>
                    </div>

                    <div class="card-footer p-0">

                        <ul class="nav flex-column">

                            <li class="list-group-item">
                                <span> National ID </span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->national_id}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Official Email</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->official_email}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Gender </span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->gender}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span> Marital Status </span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->marital_status}}</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <span> Date of Birth</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->dateOfBirth()}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Personal Email</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->personal_email}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Contact Address</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->contact_address}}</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Mobile Contact</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->mobile_contact}} </span>

                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Home Contact</span>
                                <a class="float-right">
                                    <span class="text-bold">{{$staff->home_contact}} </span>

                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Home Country</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->home_country }}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Home Village</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->home_village }}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Home T/A</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->home_authority }}
									</span>
                                </a>
                            </li>

                            <li class="list-group-item">
                                <span> Home District</span>
                                <a class="float-right">
									<span class="text-bold">
										{{ $staff->home_district }}
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
