<?php

use App\Livewire\Auth\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        
        if (auth()->user()->mode == 'admin') {
            $this->redirect(RouteServiceProvider::HOME_ADMIN, navigate: true);
        } else {
            $this->redirect(RouteServiceProvider::HOME_USER, navigate: true);
        }
    }
}; 

?>

<div>
  <p class="text-2xl font-bold text-center">Bienvenido</p>
  <form wire:submit="login" class="flex flex-col mt-8">
    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input wire:model="form.email" id="email" class="block w-full mt-1" type="email" name="email" autofocus autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />
      <x-password-input wire:model="form.password" id="password" class="block w-full mt-1" type="password" name="password" autocomplete="current-password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <div class="block mt-4">
      <label for="remember" class="inline-flex items-center">
        <input wire:model="form.remember" id="remember" type="checkbox" class="border-gray-200 rounded shadow-sm text-[#D8D089] focus:ring-current cursor-pointer" name="remember">
        <span class="text-sm cursor-pointer ms-2">{{ __('Remember me') }}</span>
      </label>
    </div>
    <x-primary-button class="mt-4 text-center">
      <span class="w-full text-center">{{ __('Log in') }}</span>
    </x-primary-button>
    <div class="flex items-center justify-between mt-5">
      <a  class="text-sm text-gray-900" href="{{ route('register') }}" wire:navigate>{{ __('Register') }}</a>
      @if (Route::has('password.request'))
        <a class="text-sm text-gray-900" href="{{ route('password.request') }}" wire:navigate>{{ __('Forgot your password?') }}</a>
      @endif
    </div>
  </form>
</div>