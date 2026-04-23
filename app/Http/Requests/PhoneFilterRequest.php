<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhoneFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'country' => ['nullable', 'string'],
            'state'   => ['nullable', 'string', 'in:valid,invalid'],
            'page'    => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function country(): ?string
    {
        return $this->filled('country') ? $this->string('country')->toString() : null;
    }

    public function state(): ?string
    {
        return $this->filled('state') ? $this->string('state')->toString() : null;
    }
}
