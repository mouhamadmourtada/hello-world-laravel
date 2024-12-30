<?php

namespace App\Http\Controllers;

use App\Http\Requests\Accommodation\StoreAccommodationRequest;
use App\Http\Requests\Accommodation\UpdateAccommodationRequest;
use App\Models\Accommodation;
use App\Services\AccommodationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccommodationController extends Controller
{
    protected $accommodationService;

    public function __construct(AccommodationService $accommodationService)
    {
        $this->accommodationService = $accommodationService;
    }

    /**
     * Display a listing of accommodations.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $type = $request->get('type');
        $status = $request->get('status');
        $sort = $request->get('sort', 'newest');

        $query = Accommodation::query()
            ->with('accommodationType');

        // Appliquer les filtres
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        }

        if ($type) {
            $query->where('accommodation_type_id', $type);
        }

        if ($status === 'available') {
            $query->where('is_available', true);
        } elseif ($status === 'occupied') {
            $query->where('is_available', false);
        }

        // Appliquer le tri
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'price_asc':
                $query->orderBy('price');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
        }

        $accommodations = $query->paginate(10)
            ->withQueryString();

        $accommodationTypes = $this->accommodationService->getAllTypes();

        return view('accommodations.index', compact('accommodations', 'accommodationTypes'));
    }

    /**
     * Display available accommodations.
     */
    public function available(): View
    {
        $accommodations = $this->accommodationService->getAvailable();
        return view('accommodations.available', compact('accommodations'));
    }

    /**
     * Show the form for creating a new accommodation.
     */
    public function create(): View
    {
        $accommodationTypes = $this->accommodationService->getAllTypes();
        return view('accommodations.create', compact('accommodationTypes'));
    }

    /**
     * Store a newly created accommodation.
     */
    public function store(StoreAccommodationRequest $request)
    {
        $accommodation = $this->accommodationService->create($request->validated());
        return redirect()->route('accommodations.index')
            ->with('success', 'Logement créé avec succès.');
    }

    /**
     * Display the specified accommodation.
     */
    public function show(int $id): View
    {
        $accommodation = $this->accommodationService->getById($id);
        return view('accommodations.show', compact('accommodation'));
    }

    /**
     * Show the form for editing the specified accommodation.
     */
    public function edit(Accommodation $accommodation): View
    {
        $accommodationTypes = $this->accommodationService->getAllTypes();
        return view('accommodations.edit', compact('accommodation', 'accommodationTypes'));
    }

    /**
     * Update the specified accommodation.
     */
    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        $this->accommodationService->update($accommodation, $request->validated());
        return redirect()->route('accommodations.index')
            ->with('success', 'Logement mis à jour avec succès.');
    }

    /**
     * Remove the specified accommodation.
     */
    public function destroy(Accommodation $accommodation)
    {
        $this->accommodationService->delete($accommodation);
        return redirect()->route('accommodations.index')
            ->with('success', 'Logement supprimé avec succès.');
    }

    /**
     * Check accommodation availability.
     */
    public function checkAvailability(int $id, string $checkIn, string $checkOut): View
    {
        $isAvailable = $this->accommodationService->checkAvailability($id, $checkIn, $checkOut);
        return view('accommodations.check-availability', compact('isAvailable'));
    }

    /**
     * Get all accommodation types.
     */
    public function types(): View
    {
        $types = $this->accommodationService->getAllTypes();
        return view('accommodations.types', compact('types'));
    }
}
