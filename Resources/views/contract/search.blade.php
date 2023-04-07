@extends('staffmanagement::layouts.app')

@section('content')

    <div class="container-fluid">

        <div class="content-header">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Contract Renewal</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('staffmanagement.module') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('contract.index') }}">Contract</a></li>
                        <li class="breadcrumb-item active">Renewal</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content">
            @livewire('staffmanagement::staff-search.search', ['route' => 'contract.create'])
        </div>
    </div>

@endsection

