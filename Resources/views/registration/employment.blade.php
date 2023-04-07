@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.supervisor"
    @endphp
    <livewire:staffmanagement::registration.employment-form :nextRoute=$nextRoute />
@endsection
