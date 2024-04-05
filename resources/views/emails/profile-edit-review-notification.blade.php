@component('mail::message')
# New Profile Edit to Review

A user  has submitted edits to their profile. Please review them in the admin dashboard.

@component('mail::button', ['url' => $editPageUrl])
Review Profile Edits
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
