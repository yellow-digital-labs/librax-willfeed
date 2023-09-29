@component('mail::message')
  {{ __('Your user request has been approved!') }}

  @component('mail::button', ['url' => $data['url']])
    {{ __('Login now') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
