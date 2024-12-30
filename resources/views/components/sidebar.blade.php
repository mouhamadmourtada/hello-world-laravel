<div class="flex h-full flex-col bg-slate-800">
    <!-- Logo -->
    <div class="flex h-24 shrink-0 items-center justify-center border-b border-slate-700 px-6">
        <img class="h-20 w-auto" src="https://th.bing.com/th/id/R.f46cdcf0479c1dd95c6157914cb5ea3a?rik=48FVKPFZ7vj5UA&pid=ImgRaw&r=0" alt="Logo">
    </div>

    <!-- Navigation -->
    <nav class="flex-1 space-y-0.5 px-3 py-4">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" 
           class="{{ request()->routeIs('dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
            <i class="ri-dashboard-line mr-3 h-5 w-5 shrink-0"></i>
            Dashboard
        </a>

        <!-- Logements -->
        <div x-data="{ open: {{ request()->routeIs('accommodations.*') ? 'true' : 'false' }} }">
            <button type="button" @click="open = !open" 
                    class="{{ request()->routeIs('accommodations.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group w-full flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
                <i class="ri-building-2-line mr-3 h-5 w-5 shrink-0"></i>
                <span class="flex-1 text-left">Logements</span>
                <i class="ri-arrow-drop-right-line ml-3 h-5 w-5 transform transition-transform duration-200" :class="{ 'rotate-90': open }"></i>
            </button>
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="transform opacity-0 -translate-y-2"
                 x-transition:enter-end="transform opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="transform opacity-100 translate-y-0"
                 x-transition:leave-end="transform opacity-0 -translate-y-2"
                 class="mt-1 space-y-1 px-2">
                <a href="{{ route('accommodations.index') }}" 
                   class="{{ request()->routeIs('accommodations.index') ? 'bg-slate-600 text-white' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }} group flex items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium transition-colors duration-200">
                    Liste des logements
                </a>
                <a href="{{ route('accommodations.create') }}" 
                   class="{{ request()->routeIs('accommodations.create') ? 'bg-slate-600 text-white' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }} group flex items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium transition-colors duration-200">
                    Ajouter un logement
                </a>
            </div>
        </div>

        <!-- Réservations -->
        <div x-data="{ open: {{ request()->routeIs('reservations.*') ? 'true' : 'false' }} }">
            <button type="button" @click="open = !open" 
                    class="{{ request()->routeIs('reservations.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group w-full flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
                <i class="ri-calendar-2-line mr-3 h-5 w-5 shrink-0"></i>
                <span class="flex-1 text-left">Réservations</span>
                <i class="ri-arrow-drop-right-line ml-3 h-5 w-5 transform transition-transform duration-200" :class="{ 'rotate-90': open }"></i>
            </button>
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="transform opacity-0 -translate-y-2"
                 x-transition:enter-end="transform opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="transform opacity-100 translate-y-0"
                 x-transition:leave-end="transform opacity-0 -translate-y-2"
                 class="mt-1 space-y-1 px-2">
                <a href="{{ route('reservations.index') }}" 
                   class="{{ request()->routeIs('reservations.index') ? 'bg-slate-600 text-white' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }} group flex items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium transition-colors duration-200">
                    Liste des réservations
                </a>
                <a href="{{ route('reservations.create') }}" 
                   class="{{ request()->routeIs('reservations.create') ? 'bg-slate-600 text-white' : 'text-slate-300 hover:bg-slate-600 hover:text-white' }} group flex items-center rounded-md py-2 pl-11 pr-2 text-sm font-medium transition-colors duration-200">
                    Nouvelle réservation
                </a>
            </div>
        </div>

        <!-- Clients -->
        <a href="{{ route('customers.index') }}" 
           class="{{ request()->routeIs('customers.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
            <i class="ri-team-line mr-3 h-5 w-5 shrink-0"></i>
            Clients
        </a>

        <!-- Services -->
        <a href="{{ route('services.index') }}" 
           class="{{ request()->routeIs('services.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
            <i class="ri-customer-service-2-line mr-3 h-5 w-5 shrink-0"></i>
            Services
        </a>

        <!-- tarif -->
        <a href="{{ route('rates.index') }}" 
           class="{{ request()->routeIs('rates.*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700 hover:text-white' }} group flex items-center rounded-lg px-3 py-2.5 text-sm font-medium transition-all duration-200">
            <i class="ri-money-euro-circle-line mr-2"></i>
            Forfait
        </a>
    </nav>

    <!-- Profil utilisateur -->
    <div class="border-t border-slate-700 bg-slate-800 p-4">
        <div class="flex items-center gap-3">
            <img class="h-9 w-9 rounded-full bg-slate-700 ring-2 ring-slate-600" 
                 src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                 alt="">
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="text-xs text-slate-400 hover:text-white transition-colors duration-200">
                        Déconnexion
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
