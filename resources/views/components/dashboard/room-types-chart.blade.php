<!-- Graphique des types de chambres -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Distribution des réservations</h3>
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <span class="flex items-center">
                <span class="w-3 h-3 inline-block rounded-full bg-primary-600 mr-1"></span>
                Deluxe
            </span>
            <span class="flex items-center">
                <span class="w-3 h-3 inline-block rounded-full bg-green-500 mr-1"></span>
                Suite Junior
            </span>
            <span class="flex items-center">
                <span class="w-3 h-3 inline-block rounded-full bg-yellow-500 mr-1"></span>
                Présidentielle
            </span>
        </div>
    </div>
    <div class="relative h-64">
        <canvas id="roomTypesChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('roomTypesChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Chambre Deluxe', 'Suite Junior', 'Suite Présidentielle'],
                datasets: [{
                    data: [45, 35, 20],
                    backgroundColor: [
                        '#4F46E5',
                        '#22C55E',
                        '#EAB308'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush
