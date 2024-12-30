<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['sometimes', 'numeric', 'min:0'],
            'category' => ['sometimes', 'string', 'max:100'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'price.numeric' => 'Le prix doit être un nombre',
            'price.min' => 'Le prix doit être positif',
            'category.max' => 'La catégorie ne doit pas dépasser 100 caractères',
        ];
    }
}
