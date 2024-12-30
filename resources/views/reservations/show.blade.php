<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- En-tête -->
                    <div class="md:flex md:items-center md:justify-between mb-6">
                        <div class="min-w-0 flex-1">
                            <h2 class="text-2xl font-bold text-gray-900">
                                Réservation #{{ $reservation->id }}
                            </h2>
                            <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="ri-calendar-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                                    Du {{ $reservation->check_in->format('d/m/Y') }} au {{ $reservation->check_out->format('d/m/Y') }}
                                </div>
                                <div class="mt-2 flex items-center text-sm">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
                            <a href="{{ route('reservations.edit', $reservation->id) }}" 
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="ri-pencil-line -ml-1 mr-2 h-5 w-5 text-gray-500"></i>
                                Modifier
                            </a>
                            <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <i class="ri-delete-bin-line -ml-1 mr-2 h-5 w-5"></i>
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations Client -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="ri-user-line mr-2"></i>
                                Informations Client
                            </h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Nom</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->customer->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->customer->email }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Téléphone</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->customer->phone }}</dd>
                                </div>
                                @if($reservation->customer->notes)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Notes</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $reservation->customer->notes }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Informations Hébergement -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="ri-home-line mr-2"></i>
                                Informations Hébergement
                            </h3>
                            <dl class="grid grid-cols-1 gap-4">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Hébergement</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->accommodation->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Type</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->accommodation->accommodationType->name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tarif</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->rate->name }} - {{ number_format($reservation->rate->price, 2, ',', ' ') }} €</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Adresse</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $reservation->accommodation->address }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Services -->
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">
                                <i class="ri-service-line mr-2"></i>
                                Services
                            </h3>
                            @if($reservation->services->count() > 0)
                                <div class="bg-white shadow overflow-hidden sm:rounded-md">
                                    <ul role="list" class="divide-y divide-gray-200">
                                        @foreach($reservation->services as $service)
                                            <li class="px-4 py-4 sm:px-6">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class="ri-checkbox-circle-line text-green-500 h-6 w-6"></i>
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $service->name }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $service->description }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center">
                                                        <div class="text-sm text-gray-900 mr-4">
                                                            Quantité: {{ $service->pivot->quantity }}
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ number_format($service->price * $service->pivot->quantity, 2, ',', ' ') }} €
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="bg-gray-50 px-4 py-4 sm:px-6">
                                        <div class="flex justify-end">
                                            <div class="text-sm font-medium text-gray-500">
                                                Total Services:
                                                <span class="ml-2 text-gray-900">
                                                    {{ number_format($reservation->services->sum(function($service) {
                                                        return $service->price * $service->pivot->quantity;
                                                    }), 2, ',', ' ') }} €
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <p class="text-sm text-gray-500">Aucun service ajouté à cette réservation.</p>
                            @endif
                        </div>

                        <!-- Total -->
                        <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-medium text-gray-900">Total Réservation</h3>
                                <div class="text-2xl font-bold text-gray-900">
                                    {{ number_format($reservation->total_price, 2, ',', ' ') }} €
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        @if($reservation->notes)
                            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-file-list-line mr-2"></i>
                                    Notes
                                </h3>
                                <p class="text-sm text-gray-900">{{ $reservation->notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
