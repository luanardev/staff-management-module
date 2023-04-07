@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.employment"
    @endphp
    <livewire:staffmanagement::registration.profile-form :nextRoute=$nextRoute />
@endsection
