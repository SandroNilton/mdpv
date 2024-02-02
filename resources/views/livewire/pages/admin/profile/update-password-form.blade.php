<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<section>
  <div class="flex flex-col bg-white border border-[#00000020] rounded shadow">
    <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
      <h3 class="float-left m-0 text-base card-title">Cambia la contraseña</h3>
    </div>
    <form wire:submit="updatePassword">
      <div class="flex-auto p-5 space-y-4">
        <div>
          <x-input-label for="update_password_current_password" :value="__('Current Password')" />
          <x-text-input wire:model="current_password" id="update_password_current_password" name="current_password" type="password" class="block w-full" autocomplete="current-password" />
          <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="update_password_password" :value="__('New Password')" />
          <x-text-input wire:model="password" id="update_password_password" name="password" type="password" class="block w-full" autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
          <x-text-input wire:model="password_confirmation" id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full" autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
      </div>
      <div class="py-3 px-5 bg-[#00000008]">
        <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
          <x-action-message class="me-3" on="password-updated">
            {{ __('Saved.') }}
          </x-action-message>
        </div>
      </div>
    </form>
</section>
