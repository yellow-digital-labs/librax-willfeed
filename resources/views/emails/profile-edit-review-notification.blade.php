<style>
.my-button {
  background-color: #007bff;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}
.my-button:hover {
  background-color: #0056b3;
}
</style>
@component('mail::message')
# New Profile Edit to Review

A user with the name <b> {{ $user->name }}</b>  ({{ $user->email }}) has submitted edits to their profile. Please review them in the admin dashboard.

<a class="btn btn-primary" href="{{$editPageUrl}}">Click me</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
