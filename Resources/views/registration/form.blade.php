@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Create Staff </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="card">
                <div class="card-header">

                    <div class="float-right">
                        <a href="{{route('staff.create.finish')}}" class="btn btn-success">
                            Finish
                        </a>
                        <a href="{{route('staff.create.cancel')}}" class="btn btn-outline-danger">

                            Cancel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">

                            <div class="nav flex-column nav-pills offset-lg-1" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a href="{{route('staff.create.profile')}}"
                                   class="nav-link {{request()->routeIs('staff.create.profile')? 'active' : '' }}">
                                    Personal Info</a>
                                <a href="{{route('staff.create.employment')}}"
                                   class="nav-link {{request()->routeIs('staff.create.employment')? 'active': '' }}">
                                    Employment</a>
                                <a href="{{route('staff.create.supervisor')}}"
                                   class="nav-link {{request()->routeIs('staff.create.supervisor')? 'active': '' }}">
                                    Supervisor</a>
                                <a href="{{route('staff.create.spouse')}}"
                                   class="nav-link {{request()->routeIs('staff.create.spouse')? 'active': '' }}">
                                    Spouse</a>
                                <a href="{{route('staff.create.kinsman')}}"
                                   class="nav-link {{request()->routeIs('staff.create.kinsman')? 'active': '' }}"> Next
                                    of Kin</a>
                                <a href="{{route('staff.create.dependants')}}"
                                   class="nav-link {{request()->routeIs('staff.create.dependants')? 'active': '' }}">
                                    Dependants</a>
                                <a href="{{route('staff.create.experience')}}"
                                   class="nav-link {{request()->routeIs('staff.create.experience')? 'active': '' }}">
                                    Work Experience</a>
                                <a href="{{route('staff.create.qualifications')}}"
                                   class="nav-link {{request()->routeIs('staff.create.qualifications')? 'active': '' }}">
                                    Qualifications</a>
                                <a href="{{route('staff.create.referees')}}"
                                   class="nav-link {{request()->routeIs('staff.create.referees')? 'active': '' }}">
                                    Referees</a>
                                <a href="{{route('staff.create.documents')}}"
                                   class="nav-link {{request()->routeIs('staff.create.documents')? 'active': '' }}">
                                    Documents</a>
                            </div>

                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @hasSection('registration-form')
                                    @yield('registration-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

