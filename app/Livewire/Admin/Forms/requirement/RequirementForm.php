<?php

namespace App\Livewire\Admin\Forms\requirement;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Requirement;
use Livewire\Form;

class RequirementForm extends Form
{
    public ?Requirement $requirement = null;

    public string $name = '';
    public ?string $description = '';
    public bool $state = true;

    public function rules(): array
    {
      return [
          'name' => ['required', 'string', 'max:255', Rule::unique('requirements')->ignore($this->requirement),], 
          'description' => ['string', 'max:255'],
      ];
    }

    public function setRequirement(Requirement $requirement)
    {
        $this->requirement = $requirement;
        $this->name = $requirement->name;
        $this->description = $requirement->description;
        $this->state = $requirement->state;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(): void
    {
        Requirement::create(['name' => Str::upper($this->name), 'description' => $this->description, 'state' => $this->state ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    public function update(): void
    {
        $this->requirement->update($this->all());
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function destroy(): string
    {
        dd($this->name.' '.$this->description.' '.$this->state);
    }
}
