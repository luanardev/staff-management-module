@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>We are pleased to offer you a CONFIRMATION OF EMPLOYMENT</p>

@component('mail::panel')
Confirmation Details
@endcomponent

@component('mail::table')
| Position | Department | Confirmed Date |
| ---------|:----------:| -----------------:|
| {{$staff->employment->getPosition()}} | {{$staff->employment->getDivision()}} | {{$staff->employment->confirmationDate()}} |

@endcomponent

{{ config('app.name') }}
@endcomponent
