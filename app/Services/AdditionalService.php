<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdditionalService
{
    /**
     * Get all services with pagination
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Service::latest()->paginate($perPage);
    }

    /**
     * Get all active services
     */
    public function getAllActive(): Collection
    {
        return Service::where('is_active', true)->get();
    }

    /**
     * Get service by ID
     */
    public function getById(int $id): ?Service
    {
        return Service::findOrFail($id);
    }

    /**
     * Create a new service
     */
    public function create(array $data): Service
    {
        return Service::create($data);
    }

    /**
     * Update a service
     */
    public function update(Service $service, array $data): bool
    {
        return $service->update($data);
    }

    /**
     * Delete a service
     */
    public function delete(Service $service): bool
    {
        return $service->delete();
    }

    /**
     * Get most popular services
     */
    public function getMostPopular(int $limit = 5): Collection
    {
        return Service::withCount('reservations')
            ->orderByDesc('reservations_count')
            ->limit($limit)
            ->get();
    }

    /**
     * Get services by category
     */
    public function getByCategory(string $category): Collection
    {
        return Service::where('category', $category)->get();
    }

    /**
     * Calculate total revenue from a service
     */
    public function calculateTotalRevenue(int $serviceId): float
    {
        $service = Service::findOrFail($serviceId);
        return $service->reservations()->count() * $service->price;
    }
}
