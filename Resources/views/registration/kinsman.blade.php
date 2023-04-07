@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.dependants"
    @endphp
    <livewire:staffmanagement::registration.kinsman-form :nextRoute=$nextRoute />
@endsection
