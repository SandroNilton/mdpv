<?php

use Illuminate\Validation\ValidationException;
use App\Livewire\Admin\Forms\typeprocedure\TypeProcedureForm;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\Attributes\On; 

use App\Models\Area;
use App\Models\Category;
use App\Models\Requirement;
use App\Models\Typeprocedure;

new #[Layout('layouts.admin')] class extends Component
{
    public $type_procedure;
    public $areas;
    public $categories;
    public $requirements;
    public TypeProcedureForm $form;

    public function mount(TypeProcedure $type_procedure): void
    {
        $this->getAreas();
        $this->getCategories();
        $this->form->setTypeProcedure($type_procedure);
    }

    #[On('area-created')] 
    public function getAreas(): void
    {
        $this->areas = Area::where('state', '=', 1)->get();
    }

    #[On('category-created')] 
    public function getCategories(): void
    {
        $this->categories = Category::where('state', '=', 1)->get();
    }

    public function update(): void
    {
        $this->form->validate();
        $this->form->update();
        $this->redirect(route('admin.type-procedures.index'), navigate: true);
    }
}; ?>

@push('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2 {
      width: 100% !important;
      font-family: unset;
    }
  </style>
@endpush

<section>
  <div class="flex flex-col bg-white border border-[#00000020] rounded shadow">
    <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
      <h3 class="float-left m-0 text-base card-title">Parametros de tipo de trámite</h3>
    </div>
    <form wire:submit="update">
      <div class="p-5 space-y-3">
        <div>
          <x-input-label for="name" :value="__('Nombre')" />
          <x-text-input wire:model="form.name" id="name" name="name" type="text" class="block w-full"/>
          <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <div>
          <x-input-label for="area" :value="__('Area')" />
          <div class="flex space-x-3">
            <x-select wire:model="form.area" name="area" id="area" class="block w-full">
              @foreach ($this->areas as $area)
                <option value="{{ $area->id }}">{{ $area->name }}</option>
              @endforeach
             </x-select>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'option-area-create')">{{ __('Agregar') }}</x-primary-button>
          </div>
        </div>
        <div>
          <x-input-label for="category" :value="__('Categoría')" />
          <div class="flex space-x-3">
            <x-select wire:model="form.category" name="category" id="category" class="block w-full">
              @foreach ($this->categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </x-select>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'option-category-create')">{{ __('Agregar') }}</x-primary-button>
          </div>
        </div>
        <div>
          <x-input-label for="requirements_async" :value="__('Requisitos')" />
          <div class="flex gap-3" wire:ignore>
            <select wire:model.lazy="form.requirements_async" name="requirements_async" id="requirements_async" class="block w-full" multiple>
              @foreach ($this->form->type_procedure->requirements as $requirement)
                <option value="{{ $requirement->id }}" selected> {{ $requirement->name }}</option>
              @endforeach
            </select>
            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'option-requirement-create')">{{ __('Agregar') }}</x-primary-button>
          </div>
          <x-input-error :messages="$errors->get('form.requirements')" class="mt-2" />
        </div>
        <div class="col-span-2">
          <x-input-label for="description" :value="__('Notas internas')"/>
          <x-textarea-input wire:model="form.description" name="description" id="description" rows="4" class="block w-full"></x-textarea-input>
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

<x-modal name="option-area-create" :show="$errors->isNotEmpty()" focusable>
  <livewire:pages.admin.area.modal.create-area-modal />
</x-modal>

<x-modal name="option-category-create" :show="$errors->isNotEmpty()" focusable>
  <livewire:pages.admin.category.modal.create-category-modal />
</x-modal>

<x-modal name="option-requirement-create" :show="$errors->isNotEmpty()" focusable>
  <livewire:pages.admin.requirement.modal.create-requirement-modal />
</x-modal>

@push('js')   
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
  @script

    <script data-navigate-once>
      document.addEventListener("livewire:navigated", () => {
        $('#requirements_async').select2({
          placeholder: '{{__('Elija sus requisitos')}}',
          ajax: {
            url: "{{ route('requirement.select2') }}",
            dataType: 'json',
            delay: 250,
            data: function(params) {
              return {
                q: params.term
              }
            },
            processResults: function(data) {
              return {
                results: data
              }
            }
          }
        });

        $('#requirements_async').on('change', function (e) {
          var data = $(this).val();
          $wire.form.requirements_async = data;
        });
      });
    </script>

  @endscript
@endpush