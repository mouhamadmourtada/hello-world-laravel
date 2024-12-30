<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900">
                            Ajouter un nouveau logement
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Remplissez les informations ci-dessous pour créer un nouveau logement.
                        </p>
                    </div>

                    <form action="{{ route('accommodations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Type de logement -->
                        <div>
                            <label for="accommodation_type_id" class="block text-sm font-medium text-gray-700">
                                Type de logement
                            </label>
                            <select id="accommodation_type_id" name="accommodation_type_id" required
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Sélectionnez un type</option>
                                @foreach($accommodationTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('accommodation_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('accommodation_type_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nom du logement
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <textarea id="description" name="description" rows="4" required
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Images
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                            <span>Télécharger des fichiers</span>
                                            <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF jusqu'à 2MB
                                    </p>
                                </div>
                            </div>
                            @error('images')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('images.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Disponibilité -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="is_available" name="is_available" type="checkbox" value="1" {{ old('is_available', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_available" class="font-medium text-gray-700">Disponible</label>
                                <p class="text-gray-500">Cochez cette case si le logement est disponible à la réservation</p>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('accommodations.index') }}"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Annuler
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                Créer le logement
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Prévisualisation des images
        const input = document.querySelector('input[type="file"]');
        const preview = document.createElement('div');
        preview.className = 'mt-4 grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4';
        input.parentElement.parentElement.parentElement.appendChild(preview);

        input.addEventListener('change', function() {
            preview.innerHTML = '';
            const files = Array.from(this.files);

            files.forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group';
                    div.innerHTML = `
                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden bg-gray-100">
                            <img src="${e.target.result}" alt="" class="object-cover">
                        </div>
                        <button type="button" class="absolute top-0 right-0 hidden group-hover:block p-1 bg-red-500 text-white rounded-full shadow-sm hover:bg-red-600 focus:outline-none">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    `;
                    
                    div.querySelector('button').addEventListener('click', function() {
                        div.remove();
                    });
                    
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    @endpush
</x-app-layout>
