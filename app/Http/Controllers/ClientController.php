<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Display a listing of clients.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $sort = $request->get('sort', 'name_asc');

        $query = Customer::query();

        // Appliquer les filtres
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($status !== null) {
            $query->where('is_active', $status);
        }

        // Appliquer le tri
        switch ($sort) {
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'created_at_desc':
                $query->orderBy('created_at', 'desc');
                break;
            case 'created_at_asc':
                $query->orderBy('created_at', 'asc');
                break;
            default: // name_asc
                $query->orderBy('name', 'asc');
        }

        $clients = $query->paginate(10)
            ->withQueryString();

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new client.
     */
    public function create(): View
    {
        return view('clients.create');
    }

    /**
     * Store a newly created client.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Client créé avec succès.');
    }

    /**
     * Display the specified client.
     */
    public function show(int $clientId): View
    {
        // dd($client);
        $client = Customer::findOrFail($clientId);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified client.
     */
    public function edit(int $clientId): View
    {
        $client = Customer::findOrFail($clientId);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified client.
     */
    public function update(Request $request, Customer $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            // 'email' => 'required|email|unique:customers,email,' . $client->id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $client->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    /**
     * Remove the specified client.
     */
    public function destroy(Customer $client)
    {
        $client->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}
