@component('mail::message')
  {{ __('You have successfully signup as :accountTypeName on WillFeed. verify this email by clicking the button below:', ["accountTypeName" => $data['accountTypeName']]) }}

  @component('mail::button', ['url' => $data['verificationUrl']])
    {{ __('Validate Email') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
