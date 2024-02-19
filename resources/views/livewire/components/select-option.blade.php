<?php

use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Volt\Component;

use App\Models\Category;
use App\Models\TypeProcedure;

new class extends Component
{
    #[Modelable]
    public $value = null;
    public $name;
    #[Reactive]
    public $options;
    
    public function mount($name, $options): void
    {
      $this->name = $name;
      $this->options = $options;
      $this->options->ensure([Category::class, TypeProcedure::class]);
    }

}; ?>

<x-select wire:model="value" class="block w-full">
  <option value="">Seleccione {{ $name }}</option>
  @foreach ($options as $option)
    <option value="{{ $option->id }}">{{ $option->name }}</option>
  @endforeach
</x-select>