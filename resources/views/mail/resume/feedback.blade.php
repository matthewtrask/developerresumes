@component('mail::message')
# Advisemyresu.me

Hello {{ $user->profile->getPreferredName() }}!

Someone has left you some feedback! Login and check it out.

@component('mail::button', ['url' => env('APP_URL') .'login'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
