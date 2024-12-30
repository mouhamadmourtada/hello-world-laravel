<div class="flex h-full flex-col bg-gradient-to-b from-gray-100 to-white">
    <!-- Logo -->
    <div class="flex h-32 mb-5 p-2 items-center justify-center border-gray-200">
        <img class="h-16 w-auto filter drop-shadow-lg rounded-full object-cover my-auto" src="https://th.bing.com/th/id/R.f46cdcf0479c1dd95c6157914cb5ea3a?rik=48FVKPFZ7vj5UA&pid=ImgRaw&r=0" alt="Logo">
    </div>


    <hr>

    <!-- Navigation -->
    <nav class="flex-1 space-y-1 px-3 py-6">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-dashboard-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Dashboard</span>
        </a>

        <!-- Logements -->
        <a href="{{ route('accommodations.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('accommodations.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-building-2-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Logements</span>
        </a>

        <a href="{{ route('accommodation-types.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('accommodation-types.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-list-settings-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Types de Logement</span>
        </a>

        <!-- Réservations -->
        <a href="{{ route('reservations.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('reservations.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-calendar-2-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Réservations</span>
        </a>

        <!-- Clients -->
        <a href="{{ route('customers.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('customers.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-team-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Clients</span>
        </a>

        <!-- Services -->
        <a href="{{ route('services.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('services.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-customer-service-2-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Services</span>
        </a>

        <!-- Tarifs -->
        <a href="{{ route('rates.index') }}" 
           class="group flex items-center rounded-xl px-4 py-3 text-sm font-medium transition-all duration-200 {{ request()->routeIs('rates.*') ? 'bg-gray-200 text-gray-900' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
            <i class="ri-money-euro-circle-line mr-3 h-5 w-5 shrink-0 transition-transform duration-200 group-hover:scale-110"></i>
            <span class="font-medium">Forfaits</span>
        </a>
    </nav>

    <!-- Profil utilisateur -->
    <div class="border-t border-gray-200 bg-gray-100 p-4">
        <div class="flex items-center gap-3">
            <div class="relative">
                <img class="h-10 w-10 rounded-full object-cover ring-2 ring-gray-300" 
                     src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                     alt="">
                <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-emerald-400 ring-2 ring-white"></span>
            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="group text-xs text-gray-500 hover:text-gray-900 transition-colors duration-200">
                        <span class="inline-flex items-center gap-1">
                            Déconnexion
                            <i class="ri-logout-box-r-line opacity-0 -translate-x-2 transition-all duration-200 group-hover:opacity-100 group-hover:translate-x-0"></i>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
