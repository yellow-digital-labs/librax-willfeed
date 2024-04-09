@component('mail::message')
# Nuovo profilo Modifica da rivedere

Nuovo profilo Modifica da rivedere
Un utente con il nome {{$user->name}} ({{$user->email}}) ha inviato modifiche al proprio profilo. Si prega di esaminarli nella dashboard di amministrazione.

<a class="btn btn-primary" href="{{$editPageUrl}}">Cliccami</a>

@endcomponent
