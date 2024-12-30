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
                                Réservations de {{ $customer->name }}
                            </h1>
                            <div class="mt-1 flex flex-col sm:flex-row sm:flex-wrap sm:mt-0 sm:space-x-6">
                                <div class="mt-2 flex items-center text-sm text-gray-500">
                                    <i class="ri-hotel-bed-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                                    {{ $reservations->total() }} réservation(s)
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4 space-x-2">
                    <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="ri-arrow-left-line -ml-1 mr-2 h-5 w-5"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Liste des réservations -->
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse ($reservations as $reservation)
                        <li>
                            <div class="px-4 py-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center flex-1 min-w-0">
                                        <div class="flex-1 min-w-0 px-4">
                                            <p class="text-sm font-medium text-indigo-600 truncate">
                                                {{ $reservation->accommodation->name }}
                                            </p>
                                            <div class="mt-2 flex">
                                                <div class="flex items-center text-sm text-gray-500 mr-6">
                                                    <i class="ri-calendar-line flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"></i>
                                                    <span>Du {{ $reservation->check_in->format('d/m/Y') }} au {{ $reservation->check_out->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
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
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="px-4 py-6 sm:px-6">
                            <div class="text-center text-gray-500">
                                Aucune réservation trouvée
                            </div>
                        </li>
                    @endforelse
                </ul>

                <div class="px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $reservations->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
