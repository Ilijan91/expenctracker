@component('mail::message')
# Hello {{$user->name}}

You have changed email address. please verify new address by clicking on the button below:

@component('mail::button', ['url' => route('verify', $user->verification_token)])
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent