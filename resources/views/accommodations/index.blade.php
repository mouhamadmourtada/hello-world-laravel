<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-shrink-0">
                    <h1 class="text-3xl font-bold text-gray-900">Logements</h1>
                    <p class="mt-2 text-sm text-gray-600">Gérez vos chambres et appartements</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('accommodations.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <i class="ri-add-line mr-2 text-lg"></i>
                        Nouveau Logement
                    </a>
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
                                       placeholder="Rechercher un logement...">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="type" class="text-sm font-medium text-gray-700">Type</label>
                            <select id="type" 
                                    name="type" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="">Tous les types</option>
                                @foreach($accommodationTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="status" class="text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" 
                                    name="status" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="">Tous les statuts</option>
                                <option value="1">Disponible</option>
                                <option value="0">Non disponible</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="sort" class="text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" 
                                    name="sort" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="newest">Plus récent</option>
                                <option value="oldest">Plus ancien</option>
                                <option value="price_asc">Prix croissant</option>
                                <option value="price_desc">Prix décroissant</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des logements -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($accommodations as $accommodation)
                    <li class="relative">
                        <div class="group block hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center px-6 py-5">
                                <div class="flex-shrink-0">
                                    <div class="h-16 w-16 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-sm">
                                        <i class="ri-home-6-line text-2xl text-white"></i>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1 px-4">
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <div class="flex items-center gap-3">
                                                <p class="text-sm font-semibold text-gray-900">{{ $accommodation->name }}</p>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    {{ $accommodation->accommodationType->name }}
                                                </span>
                                            </div>
                                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                <span class="flex items-center">
                                                    <i class="ri-money-euro-circle-line mr-1.5"></i>
                                                    {{ number_format($accommodation->price, 2, ',', ' ') }} €/nuit
                                                </span>
                                                <span class="flex items-center">
                                                    <i class="ri-map-pin-line mr-1.5"></i>
                                                    {{ $accommodation->address }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            @if($accommodation->is_available)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                    <span class="w-1 h-1 rounded-full bg-green-500"></span>
                                                    Disponible
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                    <span class="w-1 h-1 rounded-full bg-gray-500"></span>
                                                    Non disponible
                                                </span>
                                            @endif
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('accommodations.show', $accommodation) }}" 
                                                   class="relative inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                                   title="Voir les détails">
                                                    <i class="ri-eye-line text-lg"></i>
                                                </a>
                                                <a href="{{ route('accommodations.edit', $accommodation) }}" 
                                                   class="relative inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200"
                                                   title="Modifier">
                                                    <i class="ri-edit-line text-lg"></i>
                                                </a>
                                                <form action="{{ route('accommodations.destroy', $accommodation) }}" method="POST" class="relative">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce logement ?')"
                                                            class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500/20 transition-all duration-200"
                                                            title="Supprimer">
                                                        <i class="ri-delete-bin-line text-lg"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $accommodations->links() }}
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
        const sortSelect = document.getElementById('sort');

        function applyFilters() {
            const type = typeFilter.value;
            const status = statusFilter.value;
            const search = searchInput.value;
            const sort = sortSelect.value;

            window.location.href = `{{ route('accommodations.index') }}?type=${type}&status=${status}&search=${search}&sort=${sort}`;
        }

        typeFilter.addEventListener('change', applyFilters);
        statusFilter.addEventListener('change', applyFilters);
        sortSelect.addEventListener('change', applyFilters);
        
        let timeout = null;
        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilters, 500);
        });
    </script>
    @endpush
</x-app-layout>
