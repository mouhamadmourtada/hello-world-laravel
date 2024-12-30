<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête -->
            <div class="md:flex md:items-center md:justify-between mb-6">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                        {{ $accommodation->name }}
                    </h2>
                    <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="ri-building-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                            {{ $accommodation->accommodationType->name }}
                        </div>
                        <div class="mt-2 flex items-center text-sm text-gray-500">
                            <i class="ri-money-euro-circle-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                            {{ number_format($accommodation->price, 2, ',', ' ') }} €
                        </div>
                        <div class="mt-2 flex items-center text-sm">
                            <span class="{{ $accommodation->is_available ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }} px-2 py-1 rounded-full">
                                <i class="ri-checkbox-circle-line mr-1"></i>
                                {{ $accommodation->is_available ? 'Disponible' : 'Non disponible' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
                    <a href="{{ route('accommodations.edit', $accommodation->id) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-pencil-line -ml-1 mr-2 h-5 w-5 text-gray-500"></i>
                        Modifier
                    </a>
                    <form action="{{ route('accommodations.destroy', $accommodation->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet hébergement ?')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="ri-delete-bin-line -ml-1 mr-2 h-5 w-5"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 space-y-6">
                    <!-- Images -->
                    @if($accommodation->images && count($accommodation->images) > 0)
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Photos</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($accommodation->images as $image)
                                    <div class="relative aspect-w-16 aspect-h-9">
                                        <img src="{{ asset('storage/' . $image) }}" alt="Photo de {{ $accommodation->name }}" class="object-cover rounded-lg shadow-md">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Description</h3>
                        <div class="prose max-w-none text-gray-500">
                            {{ $accommodation->description }}
                        </div>
                    </div>

                    <!-- Tarifs -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tarifs</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @forelse($accommodation->rates as $rate)
                                    <div class="flex items-center justify-between p-4 bg-white rounded-lg shadow">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $rate->name }}</h4>
                                            <p class="text-sm text-gray-500">{{ $rate->description }}</p>
                                        </div>
                                        <div class="text-lg font-semibold text-gray-900">
                                            {{ number_format($rate->price, 2, ',', ' ') }} €
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 text-sm">Aucun tarif défini pour cet hébergement.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Réservations -->
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Réservations à venir</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrivée</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Départ</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($accommodation->reservations->where('check_out', '>=', now()) as $reservation)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $reservation->customer->name }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $reservation->check_in->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $reservation->check_out->format('d/m/Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                                    @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($reservation->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('reservations.show', $reservation->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                                    Voir
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                Aucune réservation à venir pour cet hébergement.
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
