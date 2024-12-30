<!-- Graphique de satisfaction client -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Satisfaction client</h3>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm bg-primary-100 text-primary-600 rounded-full">2024</button>
            <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">2023</button>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="text-center">
            <div class="text-3xl font-bold text-primary-600">96%</div>
            <div class="text-sm text-gray-500">Satisfaction globale</div>
        </div>
        <div class="text-center">
            <div class="text-3xl font-bold text-green-600">+12%</div>
            <div class="text-sm text-gray-500">vs année précédente</div>
        </div>
    </div>
    <div class="relative h-64">
        <canvas id="satisfactionChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('satisfactionChart').getContext('2d');
        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [
                    'Propreté',
                    'Service',
                    'Confort',
                    'Emplacement',
                    'Petit-déjeuner',
                    'Rapport qualité/prix'
                ],
                datasets: [{
                    label: '2024',
                    data: [95, 98, 92, 96, 94, 90],
                    fill: true,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgb(79, 70, 229)',
                    pointBackgroundColor: 'rgb(79, 70, 229)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(79, 70, 229)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: {
                            display: true
                        },
                        suggestedMin: 0,
                        suggestedMax: 100
                    }
                }
            }
        });
    });
</script>
@endpush
