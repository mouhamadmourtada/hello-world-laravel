<?php

namespace App\Http\Requests\Accommodation;

use Illuminate\Foundation\Http\FormRequest;

class StoreAccommodationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'accommodation_type_id' => ['required', 'exists:accommodation_types,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'address' => ['required', 'string'],
            'is_available' => ['boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'accommodation_type_id.required' => 'Le type d\'hébergement est requis',
            'accommodation_type_id.exists' => 'Le type d\'hébergement sélectionné n\'existe pas',
            'name.required' => 'Le nom est requis',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'description.required' => 'La description est requise',
            'images.required' => 'Au moins une image est requise',
            'images.*.image' => 'Les fichiers doivent être des images',
            'images.*.mimes' => 'Les images doivent être au format : jpeg, png, jpg, gif',
            'images.*.max' => 'La taille de l\'image ne doit pas dépasser 2Mo',
        ];
    }
}