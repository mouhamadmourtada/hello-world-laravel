<?php

namespace App\Http\Controllers;

use App\Models\AccommodationType;
use Illuminate\Http\Request;

class AccommodationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = AccommodationType::all();
        return view('accommodation-types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accommodation-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        AccommodationType::create($validated);

        return redirect()->route('accommodation-types.index')
            ->with('success', 'Type de logement créé avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccommodationType $accommodationType)
    {
        return view('accommodation-types.edit', compact('accommodationType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccommodationType $accommodationType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean'
        ]);

        $accommodationType->update($validated);

        return redirect()->route('accommodation-types.index')
            ->with('success', 'Type de logement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccommodationType $accommodationType)
    {
        $accommodationType->delete();

        return redirect()->route('accommodation-types.index')
            ->with('success', 'Type de logement supprimé avec succès.');
    }
}
