@component('mail::message')
# Hello {{$buyer->name}}

You have made new transaction for product {{$vendor->name}} amount {{$amount}} in {{$request->currency}}.
If it was you, just ignore this email.

If this was not you, please contact your bank!

Thanks,<br>
{{ config('app.name') }}
@endcomponent