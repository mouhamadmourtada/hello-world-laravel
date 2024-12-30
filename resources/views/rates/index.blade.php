<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">Liste des Tarifs</h1>
                <a href="{{ route('rates.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="ri-add-line mr-2"></i>
                    Nouveau Tarif
                </a>
            </div>

            <div class="mt-6 bg-white shadow overflow-hidden rounded-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hébergement</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type de durée</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Actions</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rates as $rate)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $rate->accommodation->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ number_format($rate->price, 2, ',', ' ') }} €
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('rates.edit', $rate) }}" class="text-indigo-600 hover:text-indigo-900">
                                            <i class="ri-pencil-line text-lg"></i>
                                        </a>
                                        <form action="{{ route('rates.destroy', $rate) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif ?')" class="text-red-600 hover:text-red-900">
                                                <i class="ri-delete-bin-line text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
