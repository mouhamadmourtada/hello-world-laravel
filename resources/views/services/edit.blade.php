<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Modifier le Service</h1>
                <a href="{{ route('services.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour
                </a>
            </div>

            <div class="mt-6">
                <form action="{{ route('services.update', $service) }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                            <div class="sm:col-span-2">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom du service</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('description', $service->description) }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $service->price) }}" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700">Statut</label>
                                <select id="is_active" name="is_active" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="1" {{ old('is_active', $service->is_active) == '1' ? 'selected' : '' }}>Actif</option>
                                    <option value="0" {{ old('is_active', $service->is_active) == '0' ? 'selected' : '' }}>Inactif</option>
                                </select>
                                @error('is_active')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="window.location='{{ route('services.index') }}'" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
