<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Liste des Clients</h1>
                <a href="{{ route('customers.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-user-add-line mr-2"></i>
                    Nouveau Client
                </a>
            </div>

            <!-- Filtres -->
            <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b border-gray-200">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700">Rechercher</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-search-line text-gray-400"></i>
                                </div>
                                <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Rechercher un client...">
                            </div>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="name_asc">Nom (A-Z)</option>
                                <option value="name_desc">Nom (Z-A)</option>
                                <option value="newest">Plus récent</option>
                                <option value="oldest">Plus ancien</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des clients -->
            <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @foreach($clients as $client)
                    <li>
                        <div class="block hover:bg-gray-50">
                            <div class="flex items-center px-4 py-4 sm:px-6">
                                <div class="min-w-0 flex-1 flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <div class="h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <span class="text-xl font-medium text-indigo-600">
                                                {{ substr($client->name, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1 px-4">
                                        <div>
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-medium text-indigo-600 truncate">{{ $client->name }}</p>
                                                <div class="ml-2 flex-shrink-0 flex">
                                                    @if($client->is_active)
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Actif
                                                        </p>
                                                    @else
                                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Inactif
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="mt-2 flex items-center text-sm text-gray-500">
                                                <i class="ri-mail-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                                <p class="truncate">{{ $client->email }}</p>
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500">
                                            <i class="ri-phone-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                            <p>{{ $client->phone }}</p>
                                            @if($client->address)
                                                <span class="mx-2">•</span>
                                                <i class="ri-map-pin-line flex-shrink-0 mr-1.5 text-gray-400"></i>
                                                <p class="truncate">{{ $client->address }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('customers.show', $client) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-eye-line text-lg"></i>
                                    </a>
                                    <a href="{{ route('customers.edit', $client) }}" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="ri-pencil-line text-lg"></i>
                                    </a>
                                    <form action="{{ route('customers.destroy', $client) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')" class="inline-flex items-center p-2 border border-transparent rounded-full shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
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
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filtrage et recherche
        const statusFilter = document.getElementById('status');
        const searchInput = document.getElementById('search');
        const sortFilter = document.getElementById('sort');

        function applyFilters() {
            const status = statusFilter.value;
            const search = searchInput.value;
            const sort = sortFilter.value;

            window.location.href = `{{ route('customers.index') }}?status=${status}&search=${search}&sort=${sort}`;
        }

        statusFilter.addEventListener('change', applyFilters);
        sortFilter.addEventListener('change', applyFilters);
        
        let timeout = null;
        searchInput.addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(applyFilters, 500);
        });
    </script>
    @endpush
</x-app-layout>
