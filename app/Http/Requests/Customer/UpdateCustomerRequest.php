<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'email',
                Rule::unique('customers')->ignore($this->customer),
            ],
            'phone' => ['sometimes', 'string', 'max:20'],
            'address' => ['sometimes', 'string'],
            'city' => ['sometimes', 'string', 'max:100'],
            'country' => ['sometimes', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'Cette adresse email est déjà utilisée',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères',
            'city.max' => 'La ville ne doit pas dépasser 100 caractères',
            'country.max' => 'Le pays ne doit pas dépasser 100 caractères',
        ];
    }
}
