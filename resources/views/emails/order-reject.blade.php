@component('mail::message')
  <h4>Order #{{$data['order_id']}}</h4>

  {{ __('Rejected by seller') }}

  @component('mail::button', ['url' => $data['url']])
    {{ __('View Order') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
