<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Liste des Logements</h1>
                <a href="{{ route('accommodations.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-add-line mr-2"></i>
                    Nouveau Logement
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
                                <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher un logement...">
                            </div>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="type" name="type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Tous les types</option>
                                @foreach($accommodationTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="1">Disponible</option>
                                <option value="0">Non disponible</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
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
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($accommodations as $accommodation)
                    <li>
                        <div class="block hover:bg-gray-50">
                            <div class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        <div class="h-16 w-16 rounded-lg bg-indigo-100 flex items-center justify-center">
                                            <i class="ri-home-6-line text-2xl text-indigo-600"></i>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1 px-4">
                                        <div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-indigo-600 truncate">{{ $accommodation->name }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    @if($accommodation->is_available)
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Disponible
                                                        </p>
                                                    @else
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Non disponible
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <i class="ri-building-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                                <p class="truncate">{{ $accommodation->accommodationType->name }}</p>
                                                <i class="ri-money-euro-circle-line flex-shrink-0 mx-1.5 text-gray-400"></i>
                                                <p>{{ number_format($accommodation->price, 2, ',', ' ') }} €/nuit</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="ri-map-pin-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                            <p class="truncate">{{ $accommodation->address }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('accommodations.show', $accommodation) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-eye-line text-lg"></i>
                                    </a>
                                    <a href="{{ route('accommodations.edit', $accommodation) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-pencil-line text-lg"></i>
                                    </a>
                                    <form action="{{ route('accommodations.destroy', $accommodation) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce logement ?')" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $accommodations->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script>
    // Filtrage et recherche
    const typeFilter = document.getElementById('type');
    const statusFilter = document.getElementById('status');
    const searchInput = document.getElementById('search');

    function applyFilters() {
        const type = typeFilter.value;
        const status = statusFilter.value;
        const search = searchInput.value;

        window.location.href = `{{ route('accommodations.index') }}?type=${type}&status=${status}&search=${search}`;
    }

    typeFilter.addEventListener('change', applyFilters);
    statusFilter.addEventListener('change', applyFilters);
    
    let timeout = null;
    searchInput.addEventListener('input', () => {
        clearTimeout(timeout);
        timeout = setTimeout(applyFilters, 500);
    });
</script>
@endpush
