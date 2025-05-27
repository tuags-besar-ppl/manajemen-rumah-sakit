@component('mail::message')
# {{ $emailSubject }}

{!! nl2br(e($emailMessage)) !!}

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
