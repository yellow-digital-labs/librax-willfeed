@component('mail::message')

  {{ __('You have new contact us request') }}

  <p>Name: {{$data['name']}}</p>
  <p>Email: {{$data['email']}}</p>
  <p>Mobile: {{$data['mobile']}}</p>
  <p>Message: {{$data['message']}}</p>

@endcomponent
