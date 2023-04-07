@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Settings </h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">

                            <div class="nav flex-column nav-pills offset-lg-1" id="v-pills-tab" role="tablist"
                                 aria-orientation="vertical">
                                <a href="{{route('staffmanagement.settings.general')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.general')? 'active' : '' }}">
                                    General</a>
                                <a href="{{route('staffmanagement.settings.position')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.position')? 'active': '' }}">
                                    Positions</a>
                                <a href="{{route('staffmanagement.settings.rank')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.rank')? 'active': '' }}">
                                    Ranks</a>
                                <a href="{{route('staffmanagement.settings.grade')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.grade')? 'active': '' }}">
                                    Grades</a>
                                <a href="{{route('staffmanagement.settings.document')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.document')? 'active': '' }}">
                                    Documents</a>
                                <a href="{{route('staffmanagement.settings.qualification')}}"
                                   class="nav-link {{request()->routeIs('staffmanagement.settings.qualification')? 'active': '' }}">
                                    Qualifications</a>

                            </div>

                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @hasSection('staff-settings-form')
                                    @yield('staff-settings-form')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

