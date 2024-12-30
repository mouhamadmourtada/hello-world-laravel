<!-- Graphique des revenus -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Revenus mensuels</h3>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm bg-primary-100 text-primary-600 rounded-full">Année</button>
            <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">Mois</button>
            <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">Semaine</button>
        </div>
    </div>
    <div class="relative h-80">
        <canvas id="revenueChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Revenus',
                    data: [65000, 59000, 80000, 81000, 86000, 95000, 100000, 110000, 92000, 85000, 88000, 98000],
                    backgroundColor: '#4F46E5',
                    borderRadius: 6,
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
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + '€';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
