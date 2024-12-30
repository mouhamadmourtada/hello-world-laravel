<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerService
{
    /**
     * Get all customers with pagination
     */
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Customer::latest()->paginate($perPage);
    }

    /**
     * Get customer by ID
     */
    public function getById(int $id): ?Customer
    {
        return Customer::with('reservations')->findOrFail($id);
    }

    /**
     * Create a new customer
     */
    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    /**
     * Update a customer
     */
    public function update(Customer $customer, array $data): bool
    {
        return $customer->update($data);
    }

    /**
     * Delete a customer
     */
    public function delete(Customer $customer): bool
    {
        return $customer->delete();
    }

    /**
     * Search customers
     */
    public function search(string $term): Collection
    {
        return Customer::where('name', 'like', "%{$term}%")
            ->orWhere('email', 'like', "%{$term}%")
            ->orWhere('phone', 'like', "%{$term}%")
            ->get();
    }

    /**
     * Get customer reservations history
     */
    public function getReservationsHistory(int $customerId): Collection
    {
        return Customer::findOrFail($customerId)
            ->reservations()
            ->with(['accommodation', 'rate'])
            ->latest()
            ->get();
    }
}
