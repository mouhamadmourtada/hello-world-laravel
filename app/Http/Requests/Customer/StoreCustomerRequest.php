<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'country' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'email.required' => 'L\'email est requis',
            'email.email' => 'L\'email doit être une adresse email valide',
            'email.unique' => 'Cette adresse email est déjà utilisée',
            'phone.required' => 'Le téléphone est requis',
            'phone.max' => 'Le téléphone ne doit pas dépasser 20 caractères',
            'address.required' => 'L\'adresse est requise',
            'city.required' => 'La ville est requise',
            'city.max' => 'La ville ne doit pas dépasser 100 caractères',
            'country.required' => 'Le pays est requis',
            'country.max' => 'Le pays ne doit pas dépasser 100 caractères',
        ];
    }
}
