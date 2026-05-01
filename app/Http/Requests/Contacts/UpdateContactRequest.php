<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'country_code' => 'sometimes|required|string|max:5',
            'number'       => [
                'sometimes',
                'required',
                'digits:9',
                Rule::unique('contacts')->where(function ($query) {
                    $code = $this->country_code ?? $this->contact->country_code;
                    return $query->where('country_code', $code);
                })->ignore($this->contact->id)
            ],
        ];
    }
}
