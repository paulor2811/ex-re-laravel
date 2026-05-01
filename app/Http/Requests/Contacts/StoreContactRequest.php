<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'person_id'    => 'required|exists:people,id',
            'country_code' => 'required|string|max:5',
            'number'       => [
                'required',
                'digits:9',
                Rule::unique('contacts')->where(function ($query) {
                    return $query->where('country_code', $this->country_code);
                })
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'number.unique' => 'Este número já está cadastrado para este país.',
            'number.digits' => 'O número deve ter exatamente 9 dígitos.'
        ];
    }
}
