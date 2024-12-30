<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Nouveau Client</h1>
                <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-arrow-left-line mr-2"></i>
                    Retour
                </a>
            </div>

            @if ($errors->any())
            <div class="mt-6">
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="ri-error-warning-line text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                Veuillez corriger les erreurs suivantes :
                            </p>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-6 bg-white shadow rounded-lg">
                <form action="{{ route('customers.store') }}" method="POST" class="space-y-6 p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Nom -->
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="john@example.com">
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                            <div class="mt-1">
                                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="+33 6 12 34 56 78">
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="sm:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                            <div class="mt-1">
                                <textarea name="address" id="address" rows="3" 
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="123 rue du Commerce, 75001 Paris">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <div class="mt-1">
                                <textarea name="notes" id="notes" rows="3" 
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
                                    placeholder="Notes ou commentaires sur le client">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        <!-- Statut -->
                        <div class="sm:col-span-2">
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active" value="1" 
                                    {{ old('is_active', true) ? 'checked' : '' }}
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="is_active" class="ml-2 block text-sm text-gray-700">
                                    Client actif
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6">
                        <button type="button" onclick="window.location='{{ route('customers.index') }}'" 
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </button>
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="ri-save-line mr-2"></i>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
