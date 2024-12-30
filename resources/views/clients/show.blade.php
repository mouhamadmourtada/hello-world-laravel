<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        {{ $client->name }}
                    </h2>
                    <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="ri-calendar-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                            Client depuis {{ $client->created_at->format('d/m/Y') }}
                        </div>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $client->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $client->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
                    <a href="{{ route('customers.edit', $client->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-pencil-line -ml-1 mr-2 h-5 w-5 text-gray-500"></i>
                        Modifier
                    </a>
                    <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-arrow-left-line -ml-1 mr-2 h-5 w-5"></i>
                        Retour
                    </a>
                </div>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
                <!-- Informations du client -->
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Informations du client
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:{{ $client->email }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $client->email }}
                                    </a>
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="tel:{{ $client->phone }}" class="text-indigo-600 hover:text-indigo-900">
                                        {{ $client->phone }}
                                    </a>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $client->address ?: 'Non renseignée' }}
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $client->notes ?: 'Aucune note' }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Statistiques -->
                <div class="bg-white shadow overflow-hidden rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Statistiques
                        </h3>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                        <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Total des réservations</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">{{ $client->reservations->count() }}</dd>
                            </div>
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Réservations actives</dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ $client->reservations->where('status', 'active')->count() }}
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Dernière réservation</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    @if($client->reservations->count() > 0)
                                        {{ $client->reservations->sortByDesc('created_at')->first()->created_at->format('d/m/Y') }}
                                    @else
                                        Aucune
                                    @endif
                                </dd>
                            </div>
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">Client depuis</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $client->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Dernières réservations -->
                <div class="lg:col-span-2 bg-white shadow overflow-hidden rounded-lg">
                    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Dernières réservations
                        </h3>
                        <a href="{{ route('reservations.create', ['client_id' => $client->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="ri-add-line -ml-1 mr-2 h-5 w-5"></i>
                            Nouvelle réservation
                        </a>
                    </div>
                    <div class="border-t border-gray-200">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Logement
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Dates
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Statut
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Prix
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($client->reservations->sortByDesc('created_at')->take(5) as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $reservation->accommodation->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $reservation->check_in->format('d/m/Y') }} - {{ $reservation->check_out->format('d/m/Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($reservation->status === 'active') bg-green-100 text-green-800
                                                    @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($reservation->total_price, 2, ',', ' ') }} €
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('reservations.show', $reservation) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                Aucune réservation
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
