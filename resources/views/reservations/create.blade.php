<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-900">Nouvelle Réservation</h1>
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                <form action="{{ route('reservations.store') }}" method="POST" class="space-y-6 p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                        <!-- Client -->
                        <div class="sm:col-span-2">
                            <label for="customer_id" class="block text-sm font-medium text-gray-700">Client</label>
                            <div class="mt-1">
                                <select id="customer_id" name="customer_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionnez un client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" {{ old('customer_id') == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }} ({{ $client->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Logement -->
                        <div class="sm:col-span-2">
                            <label for="accommodation_id" class="block text-sm font-medium text-gray-700">Logement</label>
                            <div class="mt-1">
                                <select id="accommodation_id" name="accommodation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionnez un logement</option>
                                    @foreach($accommodations as $accommodation)
                                        <option value="{{ $accommodation->id }}" {{ old('accommodation_id') == $accommodation->id ? 'selected' : '' }}>
                                            {{ $accommodation->name }} - {{ number_format($accommodation->price, 2, ',', ' ') }} €/nuit
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Tarif -->
                        <div class="sm:col-span-2">
                            <label for="rate_id" class="block text-sm font-medium text-gray-700">Tarif</label>
                            <div class="mt-1">
                                <select id="rate_id" name="rate_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Sélectionnez un tarif</option>
                                    @foreach($rates as $rate)
                                        <option value="{{ $rate->id }}" {{ old('rate_id') == $rate->id ? 'selected' : '' }}>
                                            @switch($rate->duration_type)
                                                @case('night')
                                                    Par nuit
                                                    @break
                                                @case('3_days')
                                                    3 jours
                                                    @break
                                                @case('week')
                                                    Par semaine
                                                    @break
                                                @case('month')
                                                    Par mois
                                                    @break
                                                @case('year')
                                                    Par an
                                                    @break
                                            @endswitch
                                            - {{ number_format($rate->price, 2, ',', ' ') }} €
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div>
                            <label for="check_in" class="block text-sm font-medium text-gray-700">Date d'arrivée</label>
                            <div class="mt-1">
                                <input type="date" name="check_in" id="check_in" min="{{ date('Y-m-d') }}" value="{{ old('check_in') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div>
                            <label for="check_out" class="block text-sm font-medium text-gray-700">Date de départ</label>
                            <div class="mt-1">
                                <input type="date" name="check_out" id="check_out" min="{{ date('Y-m-d') }}" value="{{ old('check_out') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Nombre de personnes -->
                        <div>
                            <label for="guests" class="block text-sm font-medium text-gray-700">Nombre de personnes</label>
                            <div class="mt-1">
                                <input type="number" name="guests" id="guests" min="1" value="{{ old('guests', 1) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <!-- Services additionnels -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Services additionnels</label>
                            <div class="mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                                @foreach($services as $service)
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" name="services[]" value="{{ $service->id }}" 
                                                {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
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

                        <!-- Notes -->
                        <div class="sm:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <div class="mt-1">
                                <textarea id="notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                            </div>
                            <p class="mt-2 text-sm text-gray-500">Ajoutez des notes ou des demandes spéciales pour cette réservation.</p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3 border-t border-gray-200 pt-6">
                        <button type="button" onclick="window.location='{{ route('reservations.index') }}'" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Annuler
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <i class="ri-save-line mr-2"></i>
                            Créer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Vérification de la disponibilité
        const checkInInput = document.getElementById('check_in');
        const checkOutInput = document.getElementById('check_out');
        const accommodationSelect = document.getElementById('accommodation_id');

        function checkAvailability() {
            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;
            const accommodationId = accommodationSelect.value;

            if (checkIn && checkOut && accommodationId) {
                fetch(`/api/accommodations/${accommodationId}/check-availability?check_in=${checkIn}&check_out=${checkOut}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.available) {
                            alert('Ce logement n\'est pas disponible pour ces dates.');
                        }
                    });
            }
        }

        checkInInput.addEventListener('change', checkAvailability);
        checkOutInput.addEventListener('change', checkAvailability);
        accommodationSelect.addEventListener('change', checkAvailability);

        // Calcul du prix total
        function calculateTotal() {
            const accommodationId = accommodationSelect.value;
            const checkIn = checkInInput.value;
            const checkOut = checkOutInput.value;
            const selectedServices = Array.from(document.querySelectorAll('input[name="services[]"]:checked')).map(cb => cb.value);

            if (accommodationId && checkIn && checkOut) {
                fetch('/api/reservations/calculate-price', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        accommodation_id: accommodationId,
                        check_in: checkIn,
                        check_out: checkOut,
                        services: selectedServices
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-price').textContent = new Intl.NumberFormat('fr-FR', {
                        style: 'currency',
                        currency: 'EUR'
                    }).format(data.total_price);
                });
            }
        }

        checkInInput.addEventListener('change', calculateTotal);
        checkOutInput.addEventListener('change', calculateTotal);
        accommodationSelect.addEventListener('change', calculateTotal);
        document.querySelectorAll('input[name="services[]"]').forEach(cb => {
            cb.addEventListener('change', calculateTotal);
        });
    </script>
    @endpush
</x-app-layout>
