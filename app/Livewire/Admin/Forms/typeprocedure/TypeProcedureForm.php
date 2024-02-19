<?php

namespace App\Livewire\Admin\Forms\typeprocedure;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\TypeProcedure;
use Livewire\Form;

class TypeProcedureForm extends Form
{
    public ?TypeProcedure $type_procedure = null;

    public string $name = '';
    public int $area = 0;
    public int $category = 0;
    public ?string $description = '';
    public bool $state = true;

    public array $requirements = [];
    public array $requirements_async = [];

    public function rules(): array
    {
      return [
          'name' => ['required', 'string', 'max:255', Rule::unique('type_procedures')->ignore($this->type_procedure),], 
          'description' => ['string', 'max:255'],
      ];
    }

    public function setTypeProcedure(TypeProcedure $type_procedure)
    {
        $this->type_procedure = $type_procedure;
        $this->name = $type_procedure->name;
        $this->area = $type_procedure->area_id;
        $this->category = $type_procedure->category_id;
        $this->description = $type_procedure->description;
        $this->state = $type_procedure->state;
        $this->requirements_async = $this->type_procedure->requirements->pluck('id')->toArray();
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(): void
    {
        $type_procedure = TypeProcedure::create(['name' => Str::upper($this->name), 'area_id' => $this->area, 'category_id' => $this->category, 'description' => $this->description, 'state' => $this->state ]);        
        $type_procedure->requirements()->sync($this->requirements);
      }

    /**
     * Ensure the authentication request is not rate limited.
     */
    public function update(): void
    {
        $this->type_procedure->update($this->all());
        $this->type_procedure->requirements()->sync($this->requirements);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function destroy(): string
    {
        dd($this->name.' '.$this->description.' '.$this->state);
    }
}
