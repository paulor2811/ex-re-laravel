<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:6',
            'email'    => 'required|email|unique:people,email,' . $this->person->id,
            'password' => 'nullable|string|min:6',
        ];
    }
}
