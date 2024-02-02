<?php

namespace App\Livewire\Admin\Forms\area;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Area;
use Livewire\Form;

class AreaForm extends Form
{
    public ?Area $area = null;

    public string $name = '';
    public ?string $description = '';
    public bool $state = true;

    public function rules(): array
    {
      return [
          'name' => ['required', 'string', 'max:255', Rule::unique('areas')->ignore($this->area),], 
          'description' => ['string', 'max:255'],
      ];
    }

    public function setArea(Area $area)
    {
        $this->area = $area;
        $this->name = $area->name;
        $this->description = $area->description;
        $this->state = $area->state;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(): void
    {
        Area::create(['name' => Str::upper($this->name), 'description' => $this->description, 'state' => $this->state ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    public function update(): void
    {
        $this->area->update($this->all());
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function destroy(): string
    {
        dd($this->name.' '.$this->description.' '.$this->state);
    }
}
