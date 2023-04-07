@component('mail::message')
<h2>Dear {{$staff->name()}}</h2>

<p>Please be advised that you are now RETIRED from the post of {{$staff->employment->getPosition()}}.</p>
<p>Below is the information pertaining your tenure.</p>
<p>
Starting Date: <strong>{{$staff->employment->startDate()}}</strong> <br/>
Period of Service: <strong>{{$staff->employment->elapsedPeriod()}}</strong> <br/>
Grade Scale: <strong>{{$staff->employment->getGradeScale()}}</strong><br/>
Current Age: <strong>{{$staff->age()}}</strong> <br/>
</p>

{{ config('app.name') }}
@endcomponent
