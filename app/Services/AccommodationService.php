<?php

namespace App\Services;

use App\Models\Accommodation;
use App\Models\AccommodationType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AccommodationService
{
    /**
     * Get all accommodations with pagination
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Accommodation::with('accommodationType')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all available accommodations
     */
    public function getAvailable(): Collection
    {
        return Accommodation::with('accommodationType')
            ->where('is_available', true)
            ->get();
    }

    /**
     * Get accommodation by ID
     */
    public function getById(int $id): ?Accommodation
    {
        return Accommodation::with([
            'accommodationType',
            'rates',
            'reservations' => function ($query) {
                $query->where('check_out', '>=', now())
                      ->orderBy('check_in');
            },
            'reservations.customer'
        ])->findOrFail($id);
    }

    /**
     * Create a new accommodation
     */
    public function create(array $data): Accommodation
    {
        // Gérer les images
        if (isset($data['images']) && !empty($data['images'])) {
            $images = [];
            foreach ($data['images'] as $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('accommodations', 'public');
                    $images[] = $path;
                }
            }
            $data['images'] = !empty($images) ? $images : null;
        } else {
            $data['images'] = null;
        }

        return Accommodation::create($data);
    }

    /**
     * Update an accommodation
     */
    public function update(Accommodation $accommodation, array $data): bool
    {
        // Gérer les images
        if (isset($data['images']) && !empty($data['images'])) {
            $images = [];
            
            // Conserver les images existantes si spécifié
            if (isset($data['existing_images']) && is_array($data['existing_images'])) {
                $images = array_merge($images, $data['existing_images']);
            }

            // Ajouter les nouvelles images
            foreach ($data['images'] as $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('accommodations', 'public');
                    $images[] = $path;
                }
            }
            
            $data['images'] = !empty($images) ? $images : null;
        } elseif (!isset($data['existing_images'])) {
            // Si aucune image n'est fournie et qu'il n'y a pas d'images existantes
            $data['images'] = null;
        }

        // Supprimer existing_images du tableau de données car ce n'est pas une colonne de la base de données
        unset($data['existing_images']);

        return $accommodation->update($data);
    }

    /**
     * Delete an accommodation
     */
    public function delete(Accommodation $accommodation): bool
    {
        return $accommodation->delete();
    }

    /**
     * Get all accommodation types
     */
    public function getAllTypes(): Collection
    {
        return AccommodationType::all();
    }

    /**
     * Check availability for specific dates
     */
    public function checkAvailability(int $accommodationId, string $checkIn, string $checkOut): bool
    {
        $accommodation = Accommodation::findOrFail($accommodationId);
        
        if (!$accommodation->is_available) {
            return false;
        }

        return !$accommodation->reservations()
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->where(function ($q) use ($checkIn, $checkOut) {
                    $q->where('check_in', '<=', $checkOut)
                      ->where('check_out', '>=', $checkIn);
                });
            })
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();
    }
}
