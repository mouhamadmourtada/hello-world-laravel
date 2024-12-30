@extends('layouts.app')

@section('content')
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center">
                        <div class="h-16 w-16 rounded-full bg-indigo-100 flex items-center justify-center">
                            <span class="text-2xl font-medium text-indigo-800">
                                {{ strtoupper(substr($customer->name, 0, 2)) }}
                            </span>
                        </div>
                        <div class="ml-4">
                            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                                {{ $customer->name }}
                            </h1>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="ri-mail-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                                    {{ $customer->email }}
                                </div>
                                @if($customer->phone)
                                    <div class="mt-2 flex items-center text-sm text-gray-500">
                                        <i class="ri-phone-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                                        {{ $customer->phone }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
                    <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-pencil-line -ml-1 mr-2 h-5 w-5 text-gray-500"></i>
                        Modifier
                    </a>
                    <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-arrow-left-line -ml-1 mr-2 h-5 w-5"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Informations du client
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Détails et historique du client
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Statut
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($customer->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Actif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactif
                                    </span>
                                @endif
                            </dd>
                        </div>

                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Date d'inscription
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $customer->created_at->format('d/m/Y') }}
                            </dd>
                        </div>

                        @if($customer->address)
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">
                                    Adresse
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $customer->address }}
                                </dd>
                            </div>
                        @endif

                        @if($customer->notes)
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">
                                    Notes
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    {{ $customer->notes }}
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="mt-8 bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Statistiques
                    </h3>
                    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                        <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                            <dt>
                                <div class="absolute bg-indigo-500 rounded-md p-3">
                                    <i class="ri-hotel-bed-line h-6 w-6 text-white"></i>
                                </div>
                                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Réservations totales</p>
                            </dt>
                            <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ $customer->reservations->count() }}
                                </p>
                            </dd>
                        </div>

                        <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                            <dt>
                                <div class="absolute bg-indigo-500 rounded-md p-3">
                                    <i class="ri-calendar-check-line h-6 w-6 text-white"></i>
                                </div>
                                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Réservations actives</p>
                            </dt>
                            <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ $customer->reservations->where('status', 'active')->count() }}
                                </p>
                            </dd>
                        </div>

                        <div class="relative bg-white pt-5 px-4 pb-12 sm:pt-6 sm:px-6 shadow rounded-lg overflow-hidden">
                            <dt>
                                <div class="absolute bg-indigo-500 rounded-md p-3">
                                    <i class="ri-time-line h-6 w-6 text-white"></i>
                                </div>
                                <p class="ml-16 text-sm font-medium text-gray-500 truncate">Dernière réservation</p>
                            </dt>
                            <dd class="ml-16 pb-6 flex items-baseline sm:pb-7">
                                <p class="text-2xl font-semibold text-gray-900">
                                    @if($lastReservation = $customer->reservations->sortByDesc('created_at')->first())
                                        {{ $lastReservation->created_at->format('d/m/Y') }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Dernières réservations -->
            @if($customer->reservations->isNotEmpty())
                <div class="mt-8 bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Dernières réservations
                        </h3>
                        <div class="mt-5">
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-gray-50">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Hébergement
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Date d'arrivée
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Date de départ
                                                        </th>
                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            Statut
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @foreach($customer->reservations->take(5) as $reservation)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                                {{ $reservation->accommodation->name }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $reservation->check_in->format('d/m/Y') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                                {{ $reservation->check_out->format('d/m/Y') }}
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-nowrap">
                                                                @switch($reservation->status)
                                                                    @case('active')
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                                            Active
                                                                        </span>
                                                                        @break
                                                                    @case('completed')
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                                            Terminée
                                                                        </span>
                                                                        @break
                                                                    @case('cancelled')
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                                            Annulée
                                                                        </span>
                                                                        @break
                                                                    @default
                                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                                            {{ $reservation->status }}
                                                                        </span>
                                                                @endswitch
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </main>
@endsection
