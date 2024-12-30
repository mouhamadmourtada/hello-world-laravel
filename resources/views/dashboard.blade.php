<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cartes de statistiques -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <x-dashboard.stats-card 
                    title="Réservations"
                    value="128"
                    percentage="12"
                    trend="up"
                    icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>'
                />
                
                <x-dashboard.stats-card 
                    title="Revenus"
                    value="52,420€"
                    percentage="8"
                    trend="up"
                    icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>'
                />
                
                <x-dashboard.stats-card 
                    title="Taux d'occupation"
                    value="89%"
                    percentage="-2"
                    trend="down"
                    icon='<svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>'
                />
                
                <x-dashboard.stats-card 
                    title="Avis clients"
                    value="4.8/5"
                    percentage="5"
                    trend="up"
                    icon='<svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>'
                />
            </div>

            <!-- Graphiques principaux -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <x-dashboard.occupancy-chart />
                <x-dashboard.revenue-chart />
            </div>

            <!-- Graphique des types de chambres et réservations récentes -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <x-dashboard.room-types-chart />
                <div class="lg:col-span-2">
                    <x-dashboard.recent-bookings />
                </div>
            </div>

            <!-- Satisfaction client et sources de réservation -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <x-dashboard.customer-satisfaction />
                <x-dashboard.booking-sources />
            </div>

            <!-- Utilisation des services et heures de pointe -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <x-dashboard.service-usage />
                <x-dashboard.peak-hours />
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush
</x-app-layout>
