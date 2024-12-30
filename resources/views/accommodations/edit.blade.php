<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Modifier l'hébergement
                        </h2>
                    </div>

                    <form action="{{ route('accommodations.update', $accommodation->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $accommodation->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type d'hébergement -->
                        <div>
                            <label for="accommodation_type_id" class="block text-sm font-medium text-gray-700">Type d'hébergement</label>
                            <select name="accommodation_type_id" id="accommodation_type_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('accommodation_type_id') border-red-500 @enderror">
                                <option value="">Sélectionnez un type</option>
                                @foreach($accommodationTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('accommodation_type_id', $accommodation->accommodation_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('accommodation_type_id')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('description') border-red-500 @enderror">{{ old('description', $accommodation->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Prix</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm">€</span>
                                </div>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $accommodation->price) }}"
                                    class="block w-full rounded-md border-gray-300 pl-7 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('price') border-red-500 @enderror"
                                    placeholder="0.00">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $accommodation->address) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('address') border-red-500 @enderror">
                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Images existantes -->
                        @if($accommodation->images && count($accommodation->images) > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Images actuelles</label>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach($accommodation->images as $index => $image)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Image {{ $index + 1 }}"
                                                class="h-32 w-full object-cover rounded-lg">
                                            <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                            <button type="button" onclick="removeImage(this)"
                                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Nouvelles images -->
                        <div>
                            <label for="images" class="block text-sm font-medium text-gray-700">Ajouter des images</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Télécharger des fichiers</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF jusqu'à 10MB</p>
                                </div>
                            </div>
                            @error('images')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disponibilité -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_available" id="is_available" value="1"
                                    {{ old('is_available', $accommodation->is_available) ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_available" class="font-medium text-gray-700">Disponible</label>
                                <p class="text-gray-500">Cochez cette case si l'hébergement est disponible à la location</p>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('accommodations.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function removeImage(button) {
            const imageContainer = button.parentElement;
            imageContainer.remove();
        }

        // Prévisualisation des images
        const input = document.querySelector('input[type="file"]');
        input.addEventListener('change', function(e) {
            const previewContainer = document.createElement('div');
            previewContainer.className = 'grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4';
            
            for (const file of this.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'relative';
                    preview.innerHTML = `
                        <img src="${e.target.result}" class="h-32 w-full object-cover rounded-lg">
                        <button type="button" onclick="this.parentElement.remove()"
                            class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    `;
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }

            const existingPreview = input.parentElement.parentElement.parentElement.querySelector('.grid');
            if (existingPreview) {
                existingPreview.remove();
            }
            input.parentElement.parentElement.parentElement.appendChild(previewContainer);
        });
    </script>
    @endpush
</x-app-layout>
