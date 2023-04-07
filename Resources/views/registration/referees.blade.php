@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.documents"
    @endphp
    <livewire:staffmanagement::registration.referee-form :nextRoute=$nextRoute />
@endsection
