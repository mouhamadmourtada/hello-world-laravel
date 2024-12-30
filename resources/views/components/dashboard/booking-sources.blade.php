<!-- Sources des réservations -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Sources des réservations</h3>
        <div class="relative">
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                <option value="30">30 derniers jours</option>
                <option value="90">90 derniers jours</option>
                <option value="365">12 derniers mois</option>
            </select>
        </div>
    </div>
    <div class="relative h-80">
        <canvas id="bookingSourcesChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('bookingSourcesChart').getContext('2d');
        new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: [
                    'Site web',
                    'Booking.com',
                    'Expedia',
                    'Agences de voyage',
                    'Téléphone',
                    'Autres'
                ],
                datasets: [{
                    data: [30, 25, 20, 15, 7, 3],
                    backgroundColor: [
                        'rgba(79, 70, 229, 0.8)',
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(107, 114, 128, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    });
</script>
@endpush
