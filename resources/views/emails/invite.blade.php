@component('mail::message')

{{ t("%s ( %s ) has invited you to join the following project on the CCRP Soils Data Platform", $invite->inviter->name, $invite->inviter->email) }}

{{ t("**Project**: %s", $invite->project->name) }}

{{ t("Click the link below to register on the platform. If you use the same email address, you will be automatically added to the project after registration.") }}

@component('mail::button', ['url' => route('register').'?token='.$invite->token])
{{ t("Register to join %s",  $invite->project->name ) }}
@endcomponent

{{ t("If you do not wish to register, or you have been sent this email by mistake, please ignore this message.") }}

{{t("Best regards,<br/>
Site Admin,<br/>
<br/>
CCRP Soils Data Platform<br/>
Soils and RMS Cross Cutting projects")}}

@endcomponent