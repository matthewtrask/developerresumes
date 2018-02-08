@component('mail::message')
#Advisemyresu.me

Hello!

Just wanted to give you a heads up we are quiely going to launch the app tonight!

Because this is a soft release, we know there are some things to work out so we really hope for some feedback via
Github issues. You can find the link to the repository on the website.

@component('mail::button', ['url' => env('APP_URL') .'register'])
    Register
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
