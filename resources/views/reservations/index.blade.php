<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-shrink-0">
                    <h1 class="text-3xl font-bold text-gray-900">Réservations</h1>
                    <p class="mt-2 text-sm text-gray-600">Gérez vos réservations et suivez leur statut</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('reservations.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <i class="ri-add-line mr-2 text-lg"></i>
                        Nouvelle Réservation
                    </a>
                </div>
            </div>

            <!-- Stats rapides -->
            <div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total des réservations -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-lg bg-indigo-50 flex items-center justify-center">
                                    <i class="ri-hotel-line text-2xl text-indigo-600"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Réservations</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">{{ $reservations->total() }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réservations en attente -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-lg bg-yellow-50 flex items-center justify-center">
                                    <i class="ri-time-line text-2xl text-yellow-600"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">En Attente</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ $reservations->where('status', 'pending')->count() }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réservations confirmées -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-lg bg-green-50 flex items-center justify-center">
                                    <i class="ri-checkbox-circle-line text-2xl text-green-600"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Confirmées</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ $reservations->where('status', 'confirmed')->count() }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Réservations annulées -->
                <div class="bg-white overflow-hidden shadow-sm rounded-lg border border-gray-100">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-lg bg-red-50 flex items-center justify-center">
                                    <i class="ri-close-circle-line text-2xl text-red-600"></i>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Annulées</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-semibold text-gray-900">
                                            {{ $reservations->where('status', 'cancelled')->count() }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-4">
                        <div class="space-y-2">
                            <label for="search" class="text-sm font-medium text-gray-700">Rechercher</label>
                            <div class="relative rounded-lg">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       class="block w-full pl-10 pr-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200" 
                                       placeholder="Rechercher une réservation...">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="status" class="text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" 
                                    name="status" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="">Tous les statuts</option>
                                <option value="pending">En attente</option>
                                <option value="confirmed">Confirmée</option>
                                <option value="cancelled">Annulée</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="date" class="text-sm font-medium text-gray-700">Date</label>
                            <input type="date" 
                                   name="date" 
                                   id="date" 
                                   class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                        </div>
                        <div class="space-y-2">
                            <label for="sort" class="text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" 
                                    name="sort" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="newest">Plus récent</option>
                                <option value="oldest">Plus ancien</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des réservations -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($reservations as $reservation)
                    <li class="relative">
                        <div class="group block hover:bg-gray-50 transition-colors duration-200">
                            <div class="px-6 py-5">
                                <!-- En-tête de la réservation -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <div class="h-16 w-16 rounded-full p-2 bg-gray-200 flex items-center justify-center shadow-sm">
                                                {{-- <i class="ri-hotel-line text-2xl text-white"></i> --}}
                                                <img src="https://picsum.photos/200/300" class="w-full h-full object-cover rounded-full bg-gray-200"  alt="">
                                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-900">
                                                {{ $reservation->accommodation->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                Réservé par {{ $reservation->customer->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        @switch($reservation->status)
                                            @case('pending')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span>
                                                    En attente
                                                </span>
                                                @break
                                            @case('confirmed')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                                    Confirmée
                                                </span>
                                                @break
                                            @case('cancelled')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                    Annulée
                                                </span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>

                                <!-- Détails de la réservation -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                    <!-- Dates -->
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-calendar-check-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Check-in:</span>
                                            <span class="ml-2 font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($reservation->check_in)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-calendar-close-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Check-out:</span>
                                            <span class="ml-2 font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($reservation->check_out)->format('d/m/Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-time-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Durée:</span>
                                            <span class="ml-2 font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($reservation->check_in)->diffInDays(\Carbon\Carbon::parse($reservation->check_out)) }} nuits
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Informations sur les invités et le prix -->
                                    <div class="flex flex-col space-y-2">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-user-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Voyageurs:</span>
                                            <span class="ml-2 font-medium text-gray-900">{{ $reservation->guests }} personne(s)</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-money-euro-circle-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Prix total:</span>
                                            <span class="ml-2 font-medium text-gray-900">{{ number_format($reservation->total_price, 2, ',', ' ') }} €</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="ri-wallet-3-line w-5 h-5 text-gray-400"></i>
                                            <span class="ml-2">Prix/nuit:</span>
                                            <span class="ml-2 font-medium text-gray-900">
                                                {{ number_format($reservation->total_price / max(1, \Carbon\Carbon::parse($reservation->check_in)->diffInDays(\Carbon\Carbon::parse($reservation->check_out))), 2, ',', ' ') }} €
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('reservations.show', $reservation) }}" 
                                           class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500/20 transition-all duration-200"
                                           title="Voir les détails">
                                            <i class="ri-eye-line mr-2"></i>
                                            Détails
                                        </a>
                                        @if($reservation->status === 'pending')
                                        <a href="{{ route('reservations.edit', $reservation) }}" 
                                           class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500/20 transition-all duration-200"
                                           title="Modifier">
                                            <i class="ri-edit-line mr-2"></i>
                                            Modifier
                                        </a>
                                        @endif
                                        @if($reservation->status !== 'cancelled')
                                        <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('GET')
                                            <button type="submit" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500/20 transition-all duration-200"
                                                    title="Annuler">
                                                <i class="ri-close-circle-line mr-2"></i>
                                                Annuler
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filtrage et recherche en temps réel
        const typeFilter = document.getElementById('type');
        const statusFilter = document.getElementById('status');
        const searchInput = document.getElementById('search');
        const dateInput = document.getElementById('date');
        const sortSelect = document.getElementById('sort');

        function applyFilters() {
            const status = statusFilter.value;
            const search = searchInput.value;
            const date = dateInput.value;
            const sort = sortSelect.value;

            window.location.href = `{{ route('reservations.index') }}?status=${status}&search=${search}&date=${date}&sort=${sort}`;
        }

        statusFilter.addEventListener('change', applyFilters);
        dateInput.addEventListener('change', applyFilters);
        sortSelect.addEventListener('change', applyFilters);
        
        let timeout = null;
        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilters, 500);
        });
    </script>
    @endpush
</x-app-layout>
