@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Staff Directory</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item active">Staff</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">List of Staff</div>
                            <div class="float-right">
                                @can('create-staff')
                                    <a class="btn btn-primary" href="{{route('staff.create')}}">
                                        <i class="fas fa-plus-circle"></i>
                                        <span
                                            class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Create</span>
                                    </a>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <livewire:staffmanagement::staff-table />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

