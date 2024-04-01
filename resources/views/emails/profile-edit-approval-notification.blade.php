@component('mail::message')
# Profile Edit {{ ucfirst($status) }}

@if($status == 'approved')
Your profile edit has been successfully approved.
@else
Your profile edit has been rejected. Reason: {{ $reason }}.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
