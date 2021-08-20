@component('mail::message')
# Bienvenue

Merci d'activer votre compte
@component('mail::button', ['url' => '', 'color' => 'green'])
Activer votre compte
@endcomponent

Merci, {{ $data->username}} de vous être inscrit sur notre application<br>
{{ config('app.name') }}
@endcomponent
