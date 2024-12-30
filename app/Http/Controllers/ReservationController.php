<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Models\Accommodation;
use App\Models\Customer;
use App\Models\Rate;
use App\Models\Reservation;
use App\Models\Service;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * Display a listing of reservations.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $date = $request->get('date');
        $sort = $request->get('sort', 'newest');

        $query = Reservation::query()
            ->with(['customer', 'accommodation']);

        // Appliquer les filtres
        if ($search) {
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('accommodation', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }

        if ($date) {
            $query->whereDate('check_in', '<=', $date)
                  ->whereDate('check_out', '>=', $date);
        }

        // Appliquer le tri
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'oldest':
                $query->oldest();
                break;
        }

        $reservations = $query->paginate(10)
            ->withQueryString();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new reservation.
     */
    public function create(): View
    {
        $clients = Customer::where('is_active', true)
            ->orderBy('name')
            ->get();

        $accommodations = Accommodation::where('is_available', true)
            ->orderBy('name')
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('name')
            ->get();

        $rates = Rate::orderBy('price')->get();

        return view('reservations.create', compact('clients', 'accommodations', 'services', 'rates'));
    }

    /**
     * Store a newly created reservation.
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = $this->reservationService->create($request->validated());
        
        if (!$reservation) {
            return back()->withInput()
                ->withErrors(['message' => 'L\'hébergement n\'est pas disponible pour ces dates']);
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation créée avec succès.');
    }

    /**
     * Display the specified reservation.
     */
    public function show(int $id): View
    {
        $reservation = $this->reservationService->getById($id);
        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified reservation.
     */
    public function edit(Reservation $reservation): View
    {
        $accommodations = Accommodation::where('is_available', true)
            ->orderBy('name')
            ->get();
        $customers = Customer::where('is_active', true)
            ->orderBy('name')
            ->get();

        $rates = Rate::orderBy('price')->get();

        $services = Service::where('is_active', true)
            ->orderBy('name')
            ->get();
        return view('reservations.edit', compact('reservation', 'accommodations', 'customers', 'rates', 'services'));
    }

    /**
     * Update the specified reservation.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $updated = $this->reservationService->update($reservation, $request->validated());
        
        if (!$updated) {
            return back()->withInput()
                ->withErrors(['message' => 'L\'hébergement n\'est pas disponible pour ces dates']);
        }

        return redirect()->route('reservations.index')
            ->with('success', 'Réservation mise à jour avec succès.');
    }

    /**
     * Cancel the specified reservation.
     */
    public function cancel(Reservation $reservation)
    {
        $this->reservationService->cancel($reservation);
        return redirect()->route('reservations.index')
            ->with('success', 'Réservation annulée avec succès.');
    }

    /**
     * Get upcoming check-ins.
     */
    public function upcomingCheckIns(): View
    {
        $checkIns = $this->reservationService->getUpcomingCheckIns();
        return view('reservations.check-ins', compact('checkIns'));
    }

    /**
     * Get upcoming check-outs.
     */
    public function upcomingCheckOuts(): View
    {
        $checkOuts = $this->reservationService->getUpcomingCheckOuts();
        return view('reservations.check-outs', compact('checkOuts'));
    }

    /**
     * Calculate total price for a reservation.
     */
    public function calculatePrice(Reservation $reservation)
    {
        $totalPrice = $this->reservationService->calculateTotalPrice($reservation);
        return back()->with('totalPrice', $totalPrice);
    }
}
