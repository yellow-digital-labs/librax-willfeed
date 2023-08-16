<x-form-section submit="updatePassword">
  <x-slot name="title">
    {{ __('Cambia password') }}
  </x-slot>

  <x-slot name="description">
    {{ __('') }}
  </x-slot>

  <x-slot name="form">
    <div class="row g-3">
      <div class="mb-3 col-md-4">
        <x-label class="form-label" for="current_password" value="{{ __('Password attuale') }}" />
        <x-input id="current_password" type="password"
          class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}" wire:model.defer="state.current_password"
          autocomplete="current-password" />
        <x-input-error for="current_password" />
      </div>
    </div>

    <div class="row g-3">
      <div class="mb-3 col-md-4">
        <x-label class="form-label" for="password" value="{{ __('Nuova password') }}" />
        <x-input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
          wire:model.defer="state.password" autocomplete="new-password" />
        <x-input-error for="password" />
      </div>

      <div class="mb-3 col-md-4">
        <x-label class="form-label" for="password_confirmation" value="{{ __('Conferma password') }}" />
        <x-input id="password_confirmation" type="password"
          class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
          wire:model.defer="state.password_confirmation" autocomplete="new-password" />
        <x-input-error for="password_confirmation" />
      </div>
    </div>

    <p class="text-black fw-semibold mt-4">Requisiti password:</p>
    <ul class="mb-5">
        <li>
            Minimum 8 characters long - the more, the better
        </li>
        <li>
            At least one uppercase character
        </li>
        <li>
            At least one number and symbol
        </li>
    </ul>
  </x-slot>


  <x-slot name="actions" class="justify-content-start">
    <x-button class="me-3">
      {{ __('Aggiorna password') }}
    </x-button>

    <a href="#" class="btn btn-outline-dark">Annulla</a>
  </x-slot>
</x-form-section>
