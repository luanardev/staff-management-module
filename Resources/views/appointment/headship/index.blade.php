@extends('staffmanagement::appointment.index')

@section('appointment')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Headship Appointments</div>
                    <div class="float-right">
                        @can('create-appointment')
                            <a class="btn btn-sm btn-primary" href="{{route('headship.search')}}">
                                <i class="fas fa-plus-circle"></i>
                                <span class="d-none d-xs-none d-sm-inline d-md-inline d-lg-inline"> Create</span>
                            </a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <livewire:staffmanagement::appointment.headship-appointment-table />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
