@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.experience"
    @endphp
    <livewire:staffmanagement::registration.dependant-form :nextRoute=$nextRoute />
@endsection
