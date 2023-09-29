@component('mail::message')
  {{ __('You have new user request as :accountTypeName on WillFeed. For verify this user details on WillFeed protal by clicking the button below:', ["accountTypeName" => $data['accountTypeName']]) }}
  
  <h4>Email: {{$data['email']}}</h4>
  <h4>Name: {{$data['name']}}</h4>

  @component('mail::button', ['url' => $data['url']])
    {{ __('View user details') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
