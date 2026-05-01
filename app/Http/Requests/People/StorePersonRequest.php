<?php

namespace App\Http\Requests\People;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:6',
            'email'    => 'required|email|unique:people,email',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'O nome deve ter pelo menos 6 caracteres.',
            'email.unique' => 'Este e-mail já está em uso.',
        ];
    }
}
