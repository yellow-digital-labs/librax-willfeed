@component('mail::message')

@if($status == 'approved')
Your profile edit has been successfully approved.
@else
La tua richiesta di aggiornamento del profilo è stata rifiutata
La modifica del tuo profilo è stata rifiutata. Motivo: {{ $reason }}
@endif

@endcomponent
