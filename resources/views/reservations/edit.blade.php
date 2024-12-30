<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- En-tête -->
                        <div class="md:flex md:items-center md:justify-between mb-6">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-2xl font-bold text-gray-900">
                                    Modifier la réservation #{{ $reservation->id }}
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informations Client -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-user-line mr-2"></i>
                                    Informations Client
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="customer_id" class="block text-sm font-medium text-gray-700">Client</label>
                                        <select name="customer_id" id="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id === $reservation->customer_id ? 'selected' : '' }}>
                                                    {{ $customer->name }} ({{ $customer->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('customer_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Informations Hébergement -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-home-line mr-2"></i>
                                    Informations Hébergement
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label for="accommodation_id" class="block text-sm font-medium text-gray-700">Hébergement</label>
                                        <select name="accommodation_id" id="accommodation_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @foreach($accommodations as $accommodation)
                                                <option value="{{ $accommodation->id }}" {{ $accommodation->id === $reservation->accommodation_id ? 'selected' : '' }}>
                                                    {{ $accommodation->name }} ({{ $accommodation->accommodationType->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('accommodation_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="rate_id" class="block text-sm font-medium text-gray-700">Tarif</label>
                                        <select name="rate_id" id="rate_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                            @foreach($rates as $rate)
                                                <option value="{{ $rate->id }}" {{ $rate->id === $reservation->rate_id ? 'selected' : '' }}>
                                                    {{ $rate->name }} - {{ number_format($rate->price, 2, ',', ' ') }} €
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('rate_id')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-calendar-line mr-2"></i>
                                    Dates
                                </h3>
                                <div class="grid grid-cols-1 gap-4">
                                    <div>
                                        <label for="check_in" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                                        <input type="date" name="check_in" id="check_in" 
                                            value="{{ old('check_in', $reservation->check_in->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('check_in')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="check_out" class="block text-sm font-medium text-gray-700">Date de départ</label>
                                        <input type="date" name="check_out" id="check_out" 
                                            value="{{ old('check_out', $reservation->check_out->format('Y-m-d')) }}"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        @error('check_out')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Statut -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-settings-line mr-2"></i>
                                    Statut
                                </h3>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                    @error('status')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Services -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    <i class="ri-service-line mr-2"></i>
                                    Services
                                </h3>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                        @foreach($services as $service)
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input type="checkbox" 
                                                        name="services[]"
                                                        value="{{ $service->id }}"
                                                        {{ $reservation->services->contains($service->id) ? 'checked' : '' }}
                                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label class="font-medium text-gray-700">{{ $service->name }}</label>
                                                    <p class="text-gray-500">{{ number_format($service->price, 2, ',', ' ') }} €</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="mt-6 flex justify-end space-x-3">
                            <a href="{{ route('reservations.show', $reservation->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>