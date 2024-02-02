<?php

use Illuminate\Validation\ValidationException;
use App\Livewire\Admin\Forms\area\AreaForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends Component
{
    public AreaForm $form;

    public function create(): void
    {
        $this->form->validate();
        $this->form->store();
        $this->redirect(route('admin.areas.index'), navigate: true);
    }
}; ?>

<section>
  <div class="flex flex-col bg-white border border-[#00000020] rounded shadow">
    <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
      <h3 class="float-left m-0 text-base card-title">Parametros de área</h3>
    </div>
    <form wire:submit="create">
      <div class="p-5 space-y-3">
        <div>
          <x-input-label for="name" :value="__('Nombre')" />
          <x-text-input wire:model="form.name" id="name" name="name" type="text" class="block w-full"/>
          <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <div class="col-span-2" wire:ignore>
          <x-input-label for="description" :value="__('Notas internas')"/>
          <x-textarea-input wire:model="form.description" name="description" rows="4" class="block w-full"></x-textarea-input>
          <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="state" :value="__('Estado')" />
          <label class="relative inline-flex items-center mb-5 cursor-pointer">
            <input type="checkbox" wire:model="form.state" id="state" name="state" value="" class="sr-only peer">
            <div class="w-9 h-5 bg-gray-200 focus:outline-none peer-focus:ring-2 peer-focus:ring-[#007bff40] rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-[#ced4da] after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-[#28A745]"></div>
          </label>
          <x-input-error :messages="$errors->get('form.state')" class="mt-2" />
        </div>
      </div>
      <div class="py-3 px-5 bg-[#00000008]">
        <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Enviar') }}</x-primary-button>
        </div>
      </div>
    </form>
</section>