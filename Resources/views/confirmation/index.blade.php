@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Job Confirmation</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item active">Confirmation</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Staff on Probation
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <livewire:staffmanagement::confirmation.probation-table />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

