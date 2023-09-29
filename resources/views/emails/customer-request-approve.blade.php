@component('mail::message')

  {{ __('Your request has been approved for purchase from :sellerName', ["sellerName" => $data["sellerName"]]) }}


  {{ __('Now, you can order by clicking link below') }}

  @component('mail::button', ['url' => $data['url']])
    {{ __('Order Now') }}
  @endcomponent

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
