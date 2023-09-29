@component('mail::message')
  {{ __('You have new order and below are the details of it!') }}

  <h4>Order #{{$data['order_id']}}</h4>
  <h4>Product: {{$data['product_name']}}</h4>
  <h4>Qty: {{$data['qty']}}</h4>

  {{ __('To view more details and approve it click on below link.') }}

  @component('mail::button', ['url' => $data['url']])
    {{ __('Verify Order') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
