<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Modifier le Tarif</h1>
                <a href="{{ route('rates.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour
                </a>
            </div>

            <div class="mt-6">
                <form action="{{ route('rates.update', $rate) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="accommodation_id" class="block text-sm font-medium text-gray-700">Hébergement</label>
                                <select id="accommodation_id" name="accommodation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionnez un hébergement</option>
                                    @foreach($accommodations as $accommodation)
                                        <option value="{{ $accommodation->id }}" {{ old('accommodation_id', $rate->accommodation_id) == $accommodation->id ? 'selected' : '' }}>
                                            {{ $accommodation->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('accommodation_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="duration_type" class="block text-sm font-medium text-gray-700">Type de durée</label>
                                <select id="duration_type" name="duration_type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="night" {{ old('duration_type', $rate->duration_type) == 'night' ? 'selected' : '' }}>Par nuit</option>
                                    <option value="3_days" {{ old('duration_type', $rate->duration_type) == '3_days' ? 'selected' : '' }}>3 jours</option>
                                    <option value="week" {{ old('duration_type', $rate->duration_type) == 'week' ? 'selected' : '' }}>Par semaine</option>
                                    <option value="month" {{ old('duration_type', $rate->duration_type) == 'month' ? 'selected' : '' }}>Par mois</option>
                                    <option value="year" {{ old('duration_type', $rate->duration_type) == 'year' ? 'selected' : '' }}>Par an</option>
                                </select>
                                @error('duration_type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $rate->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="window.location='{{ route('rates.index') }}'" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="ri-save-line mr-2"></i>
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
