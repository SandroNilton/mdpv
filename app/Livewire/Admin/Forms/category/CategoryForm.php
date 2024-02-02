<?php

namespace App\Livewire\Admin\Forms\category;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use App\Models\Category;
use Livewire\Form;

class CategoryForm extends Form
{
    public ?Category $category = null;

    public string $name = '';
    public string $description = '';
    public bool $state = true;

    public function rules(): array
    {
      return [
          'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($this->category),], 
          'description' => ['string', 'max:255'],
      ];
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->state = $category->state;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(): void
    {
        Category::create(['name' => Str::upper($this->name), 'description' => $this->description, 'state' => $this->state ]);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    public function update(): void
    {
        $this->category->update($this->all());
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function destroy(): string
    {
        dd($this->name.' '.$this->description.' '.$this->state);
    }
}
