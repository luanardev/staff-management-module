@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="content-header">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Internal Appointment</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="card">

                <div class="card-header">
                    <div class="py-1">
                        <div class="float-left">
                            <ul class="nav nav-pills" id="custom-tabs" role="tablist">
                                <li class="nav-item">
                                    <a href="{{route('general.index')}}"
                                       class="nav-link {{request()->routeIs('general.index')? 'active' : '' }}"> General
                                        Appointment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('headship.index')}}"
                                       class="nav-link {{request()->routeIs('headship.index')? 'active' : '' }}">
                                        Headship Appointment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('deanship.index')}}"
                                       class="nav-link {{request()->routeIs('deanship.index')? 'active' : '' }}">
                                        Deanship Appointment</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-content">
                        @hasSection('appointment')
                            @yield('appointment')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

