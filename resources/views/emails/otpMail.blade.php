@component('mail::message')
# Otp Reset Code
Below is your otp code and it will expire in 30secs <br>
Otp code: {{$otp}} 

@component('mail::button', ['url' => '', 'color'=> 'success'])

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
