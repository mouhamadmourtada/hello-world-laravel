<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create(): View
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        Service::create($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service créé avec succès.');
    }

    public function edit(Service $service): View
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $service->update($validated);

        return redirect()->route('services.index')
            ->with('success', 'Service mis à jour avec succès.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service supprimé avec succès.');
    }
}
