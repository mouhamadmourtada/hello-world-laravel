<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RateController extends Controller
{
    public function index(): View
    {
        $rates = Rate::with('accommodation')->get();
        return view('rates.index', compact('rates'));
    }

    public function create(): View
    {
        $accommodations = Accommodation::where('is_available', true)->get();
        return view('rates.create', compact('accommodations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'duration_type' => 'required|in:night,3_days,week,month,year',
            'price' => 'required|numeric|min:0',
        ]);

        Rate::create($validated);

        return redirect()->route('rates.index')
            ->with('success', 'Tarif créé avec succès.');
    }

    public function edit(Rate $rate): View
    {
        $accommodations = Accommodation::where('is_available', true)->get();
        return view('rates.edit', compact('rate', 'accommodations'));
    }

    public function update(Request $request, Rate $rate)
    {
        $validated = $request->validate([
            'accommodation_id' => 'required|exists:accommodations,id',
            'duration_type' => 'required|in:night,3_days,week,month,year',
            'price' => 'required|numeric|min:0',
        ]);

        $rate->update($validated);

        return redirect()->route('rates.index')
            ->with('success', 'Tarif mis à jour avec succès.');
    }

    public function destroy(Rate $rate)
    {
        $rate->delete();

        return redirect()->route('rates.index')
            ->with('success', 'Tarif supprimé avec succès.');
    }
}
