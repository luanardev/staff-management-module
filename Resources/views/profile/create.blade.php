@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Create Staff Record</h4>
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
                    <h3 class="card-title">Staff Record</h3>
                    <div class="float-right">
                        <a href="{{route('staff.create')}}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </a>
                        <a href="{{route('staff.finish')}}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-check-circle"></i>
                            <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline">Finish</span>
                        </a>
                        <a href="{{route('staff.cancel')}}" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-times-circle"></i>
                            <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline">Cancel</span>
                        </a>

                    </div>
                </div>
                <div class="card-body">
                    <x-adminlte-flash/>
                    <livewire:staffmanagement::registration.register />
                </div>
            </div>
        </div>
    </div>

@endsection

