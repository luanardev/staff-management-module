@extends('staffmanagement::profile.show')

@section('profile')
    <livewire:staffmanagement::profile.supervisor-page :staff=$staff />
@endsection
