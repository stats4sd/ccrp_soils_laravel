@component('mail::message')
# New CCRP Soils Data Plaform Contact Form Message

A new message has been received from the Soils Data Platform:

Name: **{{ $contactus->name }}**
Email: **{{ $contactus->email }}**

Message:

---

{{ $contactus->message }}

---

Thanks,<br>
{{ config('app.name') }}
@endcomponent
