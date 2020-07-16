@component('mail::message')
# Hello {{$buyer->name}}

Your spending report is as following: <br>
Daily expences : {{$rep['averagePerDay']}}<br>
Weekly expences : {{$rep['averagePerWeek']}} <br>
Monthly expences : {{$rep['averagePerMonth']}} <br>
Yearly expences : {{$rep['averagePerYear']}} <br>
Average expences per category : {{$rep['averagePerCategory']}} <br>
Top products : {{$rep['topVendors']}} <br>
Currency {{$rep['currency']}} <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent