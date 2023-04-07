@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.finish"
    @endphp
    <livewire:staffmanagement::registration.award-form :nextRoute=$nextRoute />
@endsection
