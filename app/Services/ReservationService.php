<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;

class ReservationService
{
    protected $accommodationService;

    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

    /**
     * Get all reservations with pagination
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Reservation::with(['customer', 'accommodation', 'rate'])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get reservation by ID
     */
    public function getById(int $id): ?Reservation
    {
        return Reservation::with(['customer', 'accommodation', 'rate', 'services'])
            ->findOrFail($id);
    }

    /**
     * Create a new reservation
     */
    public function create(array $data): ?Reservation
    {
        // Vérifier la disponibilité
        $isAvailable = $this->accommodationService->checkAvailability(
            $data['accommodation_id'],
            $data['check_in'],
            $data['check_out']
        );

        if (!$isAvailable) {
            return null;
        }

        // Créer la réservation
        $reservation = Reservation::create($data);

        // Attacher les services si présents
        if (isset($data['services'])) {
            $reservation->services()->attach($data['services']);
        }

        return $reservation;
    }

    /**
     * Update a reservation
     */
    public function update(Reservation $reservation, array $data): bool
    {
        // Vérifier la disponibilité seulement si les dates ou l'hébergement changent
        if (
            (isset($data['check_in']) && $data['check_in'] != $reservation->check_in->format('Y-m-d')) || 
            (isset($data['check_out']) && $data['check_out'] != $reservation->check_out->format('Y-m-d')) ||
            (isset($data['accommodation_id']) && $data['accommodation_id'] != $reservation->accommodation_id)
        ) {
            $isAvailable = $this->accommodationService->checkAvailability(
                $data['accommodation_id'] ?? $reservation->accommodation_id,
                $data['check_in'] ?? $reservation->check_in->format('Y-m-d'),
                $data['check_out'] ?? $reservation->check_out->format('Y-m-d'),
                $reservation->id
            );

            if (!$isAvailable) {
                return false;
            }
        }

        // Mettre à jour les services si présents
        if (isset($data['services'])) {
            $reservation->services()->sync($data['services']);
            unset($data['services']);
        }

        return $reservation->update($data);
    }

    /**
     * Cancel a reservation
     */
    public function cancel(Reservation $reservation): bool
    {
        return $reservation->update(['status' => 'cancelled']);
    }

    /**
     * Get upcoming check-ins
     */
    public function getUpcomingCheckIns(int $days = 7): Collection
    {
        $endDate = Carbon::now()->addDays($days);
        
        return Reservation::with(['customer', 'accommodation'])
            ->where('status', 'confirmed')
            ->where('check_in', '>=', Carbon::now())
            ->where('check_in', '<=', $endDate)
            ->orderBy('check_in')
            ->get();
    }

    /**
     * Get upcoming check-outs
     */
    public function getUpcomingCheckOuts(int $days = 7): Collection
    {
        $endDate = Carbon::now()->addDays($days);
        
        return Reservation::with(['customer', 'accommodation'])
            ->where('status', 'confirmed')
            ->where('check_out', '>=', Carbon::now())
            ->where('check_out', '<=', $endDate)
            ->orderBy('check_out')
            ->get();
    }

    /**
     * Calculate total price
     */
    public function calculateTotalPrice(Reservation $reservation): float
    {
        $nights = Carbon::parse($reservation->check_in)
            ->diffInDays(Carbon::parse($reservation->check_out));

        $accommodationPrice = $reservation->rate->price * $nights;
        
        $servicesPrice = $reservation->services->sum('price');

        return $accommodationPrice + $servicesPrice;
    }
}
