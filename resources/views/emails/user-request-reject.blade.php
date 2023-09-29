@component('mail::message')
  {{ __('Sorrry! Your user request has been rejected!') }}

  @component('mail::button', ['url' => $data['url']])
    {{ __('Login now') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
