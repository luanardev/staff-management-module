@extends('staffmanagement::profile.show')

@section('profile')
    <livewire:staffmanagement::profile.dependant-page :staff=$staff />
@endsection
