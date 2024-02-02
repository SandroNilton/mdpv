<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);

            $this->redirect($path);

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
  <div class="flex flex-col bg-white border border-[#00000020] rounded shadow">
    <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
      <h3 class="float-left m-0 text-base card-title">Información de perfil</h3>
    </div>
    <form wire:submit="updateProfileInformation">
      <div class="flex-auto p-5 space-y-4">
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input wire:model="name" id="name" name="name" type="text" class="block w-full" required autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
          <x-input-label for="email" :value="__('Email')" />
          <x-text-input wire:model="email" id="email" name="email" type="email" class="block w-full mt-1" required autocomplete="username" />
          <x-input-error class="mt-2" :messages="$errors->get('email')" />
          @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div>
              <p class="mt-2 text-sm text-gray-800">
                {{ __('Your email address is unverified.') }}
                <button wire:click.prevent="sendVerification" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                  {{ __('Click here to re-send the verification email.') }}
                </button>
              </p>
              @if (session('status') === 'verification-link-sent')
                <p class="mt-2 text-sm font-medium text-green-600">
                  {{ __('A new verification link has been sent to your email address.') }}
                </p>
              @endif
            </div>
          @endif
        </div>
      </div>
      <div class="py-3 px-5 bg-[#00000008]">
        <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
          <x-action-message class="me-3" on="profile-updated">
            {{ __('Saved.') }}
          </x-action-message>
        </div>
      </div>
    </form>
  </div>
</section>
