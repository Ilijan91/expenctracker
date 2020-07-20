@component('mail::message')
# Hello {{$buyer->name}}

Your daily status of spending goals: <br>
Daily goal : {{$goal['goal_per_day']}}<br>
Total amount spent : {{$goal['amount_spent']}} <br>
Total amount left : {{$goal['amount_left']}} <br>
Currency : {{$goal['currency']}} <br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent


