@component('mail::message')
# Introduction
Below is your otp code and it will expire in 30secs
Otp code: {{$otp}} 

@component('mail::button', ['url' => '', 'color'=> 'primary'])

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
