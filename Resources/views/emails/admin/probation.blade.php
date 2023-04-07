@component('mail::message')
<h2>Dear Admin</h2>

<p>Please be advised that PROBATION PERIOD for some Staff will EXPIRE in {{date('Y')}}.</p>
<p>You are advised to take necessary actions AS SOON AS POSSIBLE.</p>

@component('mail::panel')
List of Staff on Probation:
@endcomponent

@component('mail::table')
| Staff Name | Position | Department | End Date |
| --------------|:--------:| ------------------:| ------------------:|
@foreach ($probationList as $probation)
    | {{$probation->staff->fullname()}} | {{$probation->getPosition()}} | {{$probation->getDivision()}} | {{$probation->endDate()}} |
@endforeach
@endcomponent

@endcomponent






