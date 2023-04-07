@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.kinsman"
    @endphp
    <livewire:staffmanagement::registration.spouse-form :nextRoute=$nextRoute />
@endsection
