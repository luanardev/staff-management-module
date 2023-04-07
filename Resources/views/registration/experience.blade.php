@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.qualifications"
    @endphp
    <livewire:staffmanagement::registration.experience-form :nextRoute=$nextRoute />
@endsection
