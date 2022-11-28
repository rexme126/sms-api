@component('mail::message')
# Otp Reset Code
Below is your otp code and it will expire in 30secs <br>
Otp code: {{$otp}} 

Thanks,<br>
{{ config('app.name') }}
@endcomponent
