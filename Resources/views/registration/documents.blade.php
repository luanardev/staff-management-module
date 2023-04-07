@extends('staffmanagement::registration.form')

@section('registration-form')
    @php
        $nextRoute = "staff.create.finish"
    @endphp
    <livewire:staffmanagement::registration.document-form :nextRoute=$nextRoute />
@endsection
