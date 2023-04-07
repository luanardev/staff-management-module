@extends('staffmanagement::profile.show')

@section('profile')
    <livewire:staffmanagement::profile.employment-page :staff=$staff />
@endsection
