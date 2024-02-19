<?php

use Illuminate\Validation\ValidationException;
use App\Livewire\Admin\Forms\category\CategoryForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

use App\Models\TypeProcedure;
use App\Models\Category;

new #[Layout('layouts.user')] class extends Component
{
    public $categories;
    public $type_procedures;
    public $requirements;

    public $selectedCategory = null;
    public $selectedTypeProcedure = null;

    
    public CategoryForm $form;

    public function mount(): void
    {
        $this->categories = Category::where('state', '=', 1)->get();
    }

    public function updatedSelectedCategory($category)
    {
        $this->type_procedures = TypeProcedure::where([['state', '=', 1], ['category_id', '=', $category]])->get();
        $this->selectedTypeProcedure = null;
        $this->requirements = [];
    }

    public function updatedSelectedTypeProcedure($type_procedure)
    {
        if (is_null($type_procedure) || empty($type_procedure)) {
          $this->requirements = [];
        }
        else{
          $obj_type_procedure = new TypeProcedure();
          $obj_type_procedure->id = $type_procedure;
          $this->requirements = $obj_type_procedure->requirements()->where('state', '=', 1)->get();
        }
    }

    public function create(): void
    {
        $this->form->validate();
        $this->form->store();
        $this->redirect(route('user.procedures.index'), navigate: true);
    }
}; ?>

<section>
  <div class="flex flex-col bg-white border border-[#00000020] rounded shadow">
    <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
      <h3 class="float-left m-0 text-base card-title">Parametros de categoria</h3>
    </div>
    <form wire:submit="create">
      <div class="p-5 space-y-3">

        <div>
          <x-input-label for="category_id" :value="__('Categoría')" />
          <livewire:components.select-option name="Categoria" :options="$categories" wire:model.live='selectedCategory'>
        </div>
        
        @if (!is_null($selectedCategory))
          <div>
            <x-input-label for="type_procedure_id" :value="__('Tipo de trámite')" />
            <livewire:components.select-option name="Tipotrámite" :options="$type_procedures" wire:model.live='selectedTypeProcedure'>
          </div>
        @endif

        @if (!is_null($selectedTypeProcedure))
          <div>
            <x-input-label for="category_id" :value="__('Requisitos')" />
            <div class="bg-[#F4F6F9] p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 rounded">
              @forelse ($requirements as $requirement)
                <div class="col-span-3 md:col-span-1 border border-dashed border-[#d9d9da] flex flex-row rounded">
                  <input type="hidden" name="files[][id]" value="{{ $requirement->id }}">
                  <div class="px-4 inline-flex items-center border-r border-[#d9d9da] bg-white rounded-l-md">
                    <span class="text-[13px] text-[#414d6a]">{{ $requirement->name }}</span>
                  </div>
                  <input name="files[][file]" id="files" class="cursor-pointer rounded w-full flex text-sm text-center justify-center bg-white py-1.5 px-3.5 relative m-0 flex-auto duration-300 ease-in-out file:hidden focus:outline-none" type="file" accept="" ref="fileInput" @required(true)>
                </div>
              @empty
                <div class="col-span-4 w-full border border-dashed border-[#ced4da] flex flex-row rounded">
                  <div class="rounded w-full flex py-1.5 justify-center">
                    <span class="text-sm">No hay requisitos</span>
                  </div>
                </div>
              @endforelse
            </div>
          </div>
        @endif
        
        <div class="col-span-2" wire:ignore>
          <x-input-label for="description" :value="__('Notas internas')"/>
          <x-textarea-input wire:model="form.description" name="description" rows="4" class="block w-full"></x-textarea-input>
          <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>
      </div>
      <div class="py-3 px-5 bg-[#00000008]">
        <div class="flex items-center gap-4">
          <x-primary-button>{{ __('Enviar') }}</x-primary-button>
        </div>
      </div>
    </form>
</section>