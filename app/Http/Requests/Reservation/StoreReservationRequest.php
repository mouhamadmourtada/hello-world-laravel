<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'accommodation_id' => ['required', 'exists:accommodations,id'],
            'rate_id' => ['required', 'exists:rates,id'],
            'check_in' => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'services' => ['sometimes', 'array'],
            'services.*' => ['exists:services,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Le client est requis',
            'customer_id.exists' => 'Le client sélectionné n\'existe pas',
            'accommodation_id.required' => 'L\'hébergement est requis',
            'accommodation_id.exists' => 'L\'hébergement sélectionné n\'existe pas',
            'rate_id.required' => 'Le tarif est requis',
            'rate_id.exists' => 'Le tarif sélectionné n\'existe pas',
            'check_in.required' => 'La date d\'arrivée est requise',
            'check_in.date' => 'La date d\'arrivée doit être une date valide',
            'check_in.after_or_equal' => 'La date d\'arrivée doit être aujourd\'hui ou une date ultérieure',
            'check_out.required' => 'La date de départ est requise',
            'check_out.date' => 'La date de départ doit être une date valide',
            'check_out.after' => 'La date de départ doit être après la date d\'arrivée',
            'services.*.exists' => 'Un des services sélectionnés n\'existe pas',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('check_in')) {
            $this->merge([
                'check_in' => Carbon::parse($this->check_in)->startOfDay(),
            ]);
        }

        if ($this->has('check_out')) {
            $this->merge([
                'check_out' => Carbon::parse($this->check_out)->endOfDay(),
            ]);
        }
    }
}
