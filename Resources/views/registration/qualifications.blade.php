@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.referees"
    @endphp
    <livewire:staffmanagement::registration.qualification-form :nextRoute=$nextRoute />
@endsection
