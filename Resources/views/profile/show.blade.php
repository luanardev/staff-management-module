@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">{{$staff->fullname()}} </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="card">
                <div class="card-header">

                    <div class="float-right">

                        <a href="{{route(request()->route()->getName(), $staff)}}" class="btn btn-outline-primary">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </a>
                        <a href="{{route('staff.export', $staff->id)}}" class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-download"></i>
                            Download
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">

                            <div class="nav flex-column nav-pills offset-lg-1" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a href="{{route('staff.show.profile', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.profile')? 'active' : '' }}">
                                    Personal Info</a>
                                <a href="{{route('staff.show.employment', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.employment')? 'active': '' }}">
                                    Employment</a>
                                <a href="{{route('staff.show.supervisor', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.supervisor')? 'active': '' }}">
                                    Supervisor</a>
                                <a href="{{route('staff.show.spouse', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.spouse')? 'active': '' }}">
                                    Spouse</a>
                                <a href="{{route('staff.show.kinsman', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.kinsman')? 'active': '' }}"> Next of
                                    Kin</a>
                                <a href="{{route('staff.show.dependants', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.dependants')? 'active': '' }}">
                                    Dependants</a>
                                <a href="{{route('staff.show.experience', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.experience')? 'active': '' }}"> Work
                                    Experience</a>
                                <a href="{{route('staff.show.qualifications', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.qualifications')? 'active': '' }}">
                                    Qualifications</a>
                                <a href="{{route('staff.show.referees', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.referees')? 'active': '' }}">
                                    Referees</a>
                                <a href="{{route('staff.show.documents', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.documents')? 'active': '' }}">
                                    Documents</a>
                                <a href="{{route('staff.show.progress', $staff)}}"
                                   class="nav-link {{request()->routeIs('staff.show.progress')? 'active': '' }}"> Career
                                    Progress</a>
                            </div>

                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @hasSection('profile')
                                    @yield('profile')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    @can('delete-staff')
                        <a href="{{route('staff.destroy', $staff->id)}}" class="btn btn-outline-danger float-right">
                            <i class="fas fa-trash"></i>
                            Delete
                        </a>
                    @endcan

                </div>
            </div>
        </div>
    </div>
@endsection

