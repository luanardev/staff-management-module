@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Create Staff</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('staff.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Create Staff</li>
                    </ol>
                </div>
            </div>

        </div>

        <div class="content">

            <div class="card card-success">

                <div class="card-body">
                    <h5>Staff Record for {{$staff->fullname()}} has been created successfully!</h5> <br/>
                    <h6>You may proceed to update staff information or create a new staff record</h6> <br/>
                    <a href="{{route('staff.create')}}" class="btn btn-outline-success">New Record</a>
                    <a href="{{route('staff.show', $staff)}}" class="btn btn-outline-primary">Update Record</a>
                </div>


            </div>


        </div>
    </div>

@endsection

