@component('mail::message')

{{ $invite->inviter->name }} ( {{ $invite->inviter->email }}) has invited you to join the following project on the CCRP Soils Data Platform:

**Project**: {{  $invite->project->name }}

Click the link below to register on the platform. If you use the same email address, you will be automatically added to the project after registration.

@component('mail::button', ['url' => route('register').'?token='.$invite->token])
Register to join {{ $invite->project->name }}
@endcomponent

If you do not wish to register, or you have been sent this email by mistake, please ignore this message.

Best regards,
Site Admin,

CCRP Soils Data Platform
Soils and RMS Cross Cutting projects

@endcomponent