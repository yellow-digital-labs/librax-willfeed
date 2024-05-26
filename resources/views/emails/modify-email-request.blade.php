@component('mail::message')
# Verifica il tuo nuovo indirizzo email

Facendo clic sul collegamento sottostante potrai verificare il nuovo indirizzo email per accedere a WillFeed

<a class="btn btn-primary" href="{{ route('modify.email-verification', $mailData['token'] ) }}">Verifica nuova email</a>

<i>se non lo hai richiesto. Per favore ignora.</i>

@endcomponent

