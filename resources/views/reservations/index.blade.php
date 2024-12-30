<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Liste des Réservations</h1>
                <a href="{{ route('reservations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-add-line mr-2"></i>
                    Nouvelle Réservation
                </a>
            </div>

            <!-- Filtres -->
            <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                                <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher une réservation...">
                            </div>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="pending">En attente</option>
                                <option value="confirmed">Confirmée</option>
                                <option value="cancelled">Annulée</option>
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" id="date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="newest">Plus récent</option>
                                <option value="oldest">Plus ancien</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des réservations -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($reservations as $reservation)
                    <li>
                        <div class="block hover:bg-gray-50">
                            <div class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        {{-- @if($reservation->accommodation->images)
                                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ asset('storage/' . json_decode($reservation->accommodation->images)[0]) }}" alt="{{ $reservation->accommodation->name }}">
                                        @else --}}
                                            <div class="h-16 w-16 rounded-lg bg-gray-100 flex items-center justify-center">
                                                <i class="ri-hotel-line text-2xl text-gray-400"></i>
                                            </div>
                                        {{-- @endif --}}
                                    </div>
                                    <div class="min-w-0 flex-1 px-4">
                                        <div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{ $reservation->customer->name }} - {{ $reservation->accommodation->name }}
                                                </p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    @switch($reservation->status)
                                                        @case('pending')
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                                En attente
                                                            </p>
                                                            @break
                                                        @case('confirmed')
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                                Confirmée
                                                            </p>
                                                            @break
                                                        @case('cancelled')
                                                            <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                                Annulée
                                                            </p>
                                                            @break
                                                    @endswitch
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <i class="ri-calendar-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                                <p>Du {{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="ri-money-euro-circle-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                            <p>{{ number_format($reservation->total_price, 2, ',', ' ') }} €</p>
                                            <span class="mx-2">•</span>
                                            <i class="ri-user-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                            <p>{{ $reservation->guests }} personne(s)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('reservations.show', $reservation) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-eye-line text-lg"></i>
                                    </a>
                                    @if($reservation->status === 'pending')
                                    <a href="{{ route('reservations.edit', $reservation) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-pencil-line text-lg"></i>
                                    </a>
                                    @endif
                                    @if($reservation->status !== 'cancelled')
                                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="ri-close-circle-line text-lg"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filtrage et recherche
        const statusFilter = document.getElementById('status');
        const dateFilter = document.getElementById('date');
        const searchInput = document.getElementById('search');
        const sortFilter = document.getElementById('sort');

        function applyFilters() {
            const status = statusFilter.value;
            const date = dateFilter.value;
            const search = searchInput.value;
            const sort = sortFilter.value;

            window.location.href = `{{ route('reservations.index') }}?status=${status}&date=${date}&search=${search}&sort=${sort}`;
        }

        statusFilter.addEventListener('change', applyFilters);
        dateFilter.addEventListener('change', applyFilters);
        sortFilter.addEventListener('change', applyFilters);
        
        let timeout = null;
        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilters, 500);
        });
    </script>
    @endpush
</x-app-layout>
