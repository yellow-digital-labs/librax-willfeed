@component('mail::message')

  {{ __('Sorry! Your purchase request has been rejected from :sellerName', ["sellerName" => $data["sellerName"]]) }}

  {{ __('If you did not expect to receive an email, you may discard this email.') }}
@endcomponent
