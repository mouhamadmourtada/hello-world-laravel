<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => ['sometimes', 'exists:customers,id'],
            'accommodation_id' => ['sometimes', 'exists:accommodations,id'],
            'rate_id' => ['sometimes', 'exists:rates,id'],
            'check_in' => ['sometimes', 'date'],
            'check_out' => ['sometimes', 'date', 'after:check_in'],
            'status' => ['sometimes', 'in:pending,confirmed,cancelled,completed'],
            'services' => ['sometimes', 'array'],
            'services.*' => ['exists:services,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.exists' => 'Le client sélectionné n\'existe pas',
            'accommodation_id.exists' => 'L\'hébergement sélectionné n\'existe pas',
            'rate_id.exists' => 'Le tarif sélectionné n\'existe pas',
            'check_in.date' => 'La date d\'arrivée doit être une date valide',
            'check_out.date' => 'La date de départ doit être une date valide',
            'check_out.after' => 'La date de départ doit être après la date d\'arrivée',
            'status.in' => 'Le statut doit être : pending, confirmed, cancelled ou completed',
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
