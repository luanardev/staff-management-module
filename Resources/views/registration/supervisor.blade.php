@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.spouse"
    @endphp
    <livewire:staffmanagement::registration.supervisor-form :nextRoute=$nextRoute />
@endsection
