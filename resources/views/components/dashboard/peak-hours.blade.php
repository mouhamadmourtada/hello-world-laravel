<!-- Heures de pointe -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Heures de pointe</h3>
        <div class="flex space-x-2">
            <button class="px-3 py-1 text-sm bg-primary-100 text-primary-600 rounded-full">Check-in</button>
            <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">Check-out</button>
        </div>
    </div>
    <div class="relative h-80">
        <canvas id="peakHoursChart"></canvas>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('peakHoursChart').getContext('2d');
        new Chart(ctx, {
            type: 'bubble',
            data: {
                datasets: [{
                    label: 'Lundi-Vendredi',
                    data: [
                        { x: 8, y: 20, r: 15 },
                        { x: 10, y: 15, r: 10 },
                        { x: 12, y: 8, r: 8 },
                        { x: 14, y: 12, r: 10 },
                        { x: 16, y: 25, r: 18 },
                        { x: 18, y: 15, r: 12 }
                    ],
                    backgroundColor: 'rgba(79, 70, 229, 0.6)'
                }, {
                    label: 'Week-end',
                    data: [
                        { x: 8, y: 15, r: 12 },
                        { x: 10, y: 20, r: 15 },
                        { x: 12, y: 10, r: 8 },
                        { x: 14, y: 15, r: 12 },
                        { x: 16, y: 30, r: 20 },
                        { x: 18, y: 18, r: 14 }
                    ],
                    backgroundColor: 'rgba(34, 197, 94, 0.6)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        min: 6,
                        max: 20,
                        title: {
                            display: true,
                            text: 'Heure de la journée'
                        }
                    },
                    y: {
                        min: 0,
                        title: {
                            display: true,
                            text: 'Nombre de check-ins'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.raw.y} check-ins à ${context.raw.x}h`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
