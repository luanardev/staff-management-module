@component('mail::message')
<h2>Dear {{$employment->staff->name()}}</h2>

<p>Please be advised that we have created a staff record for you in our system.</p>
<p>Below is the information pertaining your employment.</p>
<p>
Staff ID : <strong>{{$employment->staff->employee_number}}</strong> <br/>
Staff Email: <strong>{{$employment->staff->emailAddress()}}</strong> <br/>
Position: <strong>{{$employment->getPosition()}}</strong> <br/>
Grade Scale: <strong>{{$employment->getGradeScale()}}</strong><br/>
Appointment: <strong>{{$employment->getJobType()}}</strong> <br/>
Department: <strong>{{$employment->getDepartment()}}</strong> <br/>
Campus: <strong>{{$employment->getCampus()}}</strong>
</p>

{{ config('app.name') }}
@endcomponent
