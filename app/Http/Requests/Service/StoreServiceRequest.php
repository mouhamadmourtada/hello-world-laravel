<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['required', 'string', 'max:100'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'price.required' => 'Le prix est requis',
            'price.numeric' => 'Le prix doit être un nombre',
            'price.min' => 'Le prix doit être positif',
            'category.required' => 'La catégorie est requise',
            'category.max' => 'La catégorie ne doit pas dépasser 100 caractères',
        ];
    }
}
