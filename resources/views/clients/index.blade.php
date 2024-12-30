<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-shrink-0">
                    <h1 class="text-3xl font-bold text-gray-900">Clients</h1>
                    <p class="mt-2 text-sm text-gray-600">Gérez vos clients et leurs informations</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('customers.create') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                        <i class="ri-user-add-line mr-2 text-lg"></i>
                        Nouveau Client
                    </a>
                </div>
            </div>

            <!-- Filtres -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
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
                                       placeholder="Rechercher un client...">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="sort" class="text-sm font-medium text-gray-700">Trier par</label>
                            <select id="sort" 
                                    name="sort" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="name_asc">Nom (A-Z)</option>
                                <option value="name_desc">Nom (Z-A)</option>
                                <option value="newest">Plus récent</option>
                                <option value="oldest">Plus ancien</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label for="status" class="text-sm font-medium text-gray-700">Statut</label>
                            <select id="status" 
                                    name="status" 
                                    class="block w-full px-4 py-2.5 text-sm text-gray-900 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-colors duration-200">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Liste des clients -->
            <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <ul role="list" class="divide-y divide-gray-100">
                    @foreach($clients as $client)
                    <li class="relative">
                        <div class="group block hover:bg-gray-50 transition-colors duration-200">
                            <div class="flex items-center px-6 py-5">
                                <div class="flex-shrink-0">
                                    <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-sm">
                                        <span class="text-xl font-semibold text-white">
                                            {{ substr($client->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="min-w-0 flex-1 px-4">
                                    <div class="flex items-center justify-between">
                                        <div class="space-y-1">
                                            <p class="text-sm font-semibold text-gray-900">{{ $client->name }}</p>
                                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                <span class="flex items-center">
                                                    <i class="ri-mail-line mr-1.5"></i>
                                                    {{ $client->email }}
                                                </span>
                                                @if($client->phone)
                                                    <span class="flex items-center">
                                                        <i class="ri-phone-line mr-1.5"></i>
                                                        {{ $client->phone }}
                                                    </span>
                                                @endif
                                            </div>
                                            @if($client->address)
                                                <p class="text-sm text-gray-500 flex items-center">
                                                    <i class="ri-map-pin-line mr-1.5"></i>
                                                    {{ $client->address }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-4">
                                            @if($client->is_active)
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                    <span class="w-1 h-1 rounded-full bg-green-500"></span>
                                                    Actif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                    <span class="w-1 h-1 rounded-full bg-gray-500"></span>
                                                    Inactif
                                                </span>
                                            @endif
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('customers.show', $client) }}" 
                                                   class="relative inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-blue-600 hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-200"
                                                   title="Voir les détails">
                                                    <i class="ri-eye-line text-lg"></i>
                                                </a>
                                                <a href="{{ route('customers.edit', $client) }}" 
                                                   class="relative inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 transition-all duration-200"
                                                   title="Modifier">
                                                    <i class="ri-edit-line text-lg"></i>
                                                </a>
                                                <form action="{{ route('customers.destroy', $client) }}" method="POST" class="relative">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')"
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
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Filtrage et recherche en temps réel
        const searchInput = document.getElementById('search');
        const sortSelect = document.getElementById('sort');
        const statusSelect = document.getElementById('status');

        function applyFilters() {
            // Implémenter la logique de filtrage ici
        }

        searchInput.addEventListener('input', applyFilters);
        sortSelect.addEventListener('change', applyFilters);
        statusSelect.addEventListener('change', applyFilters);
    </script>
    @endpush
</x-app-layout>
