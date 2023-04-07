@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Staff Attrition</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('attrition.index') }}">Staff</a></li>
                        <li class="breadcrumb-item active">Attrition</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="card card-outline">
                <div class="card-header">
                    <div class="card-title">
                        People who are no longer employees
                    </div>
                    <div class="float-right">
                        <a href="{{route('attrition.search')}}" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i> Create
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:staffmanagement::attrition.attrition-table />
                </div>
            </div>
        </div>
    </div>

@endsection

