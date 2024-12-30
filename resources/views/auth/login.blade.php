<x-auth-layout>
    <div class="min-h-screen flex">
        <!-- Section formulaire -->
        <div class="flex-1 flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="h-12 w-auto"/>
                    </div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Bienvenue
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Ou
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            créez un nouveau compte
                        </a>
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                    @csrf
                    <div class="space-y-5">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Adresse email
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input id="email" name="email" type="email" required 
                                    class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                                    placeholder="admin@exemple.com"/>
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Mot de passe
                            </label>
                            <div class="mt-1 relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                        <path d="M7 11V7a5 5 0 0110 0v4"/>
                                    </svg>
                                </div>
                                <input id="password" name="password" type="password" required
                                    class="pl-10 appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                                    placeholder="••••••••"/>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded"/>
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Se souvenir de moi
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-primary-600 hover:text-primary-500">
                                        Mot de passe oublié ?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit"
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-primary-400 group-hover:text-primary-300 transition ease-in-out duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </span>
                                Se connecter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section animation/image -->
        <div class="hidden lg:flex flex-1 relative bg-gradient-to-br from-primary-500 to-secondary-500 overflow-hidden">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="relative w-full h-full flex items-center justify-center p-12">
                <!-- Animation Lottie ou Image -->
                <div class="w-full max-w-lg">
                    <div class="relative">
                        <img src="{{ asset('images/hotel-illustration.svg') }}" alt="Hotel Illustration" class="w-full h-auto"/>
                        <!-- Cercles décoratifs animés -->
                        <div class="absolute -top-4 -left-4 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
                        <div class="absolute -bottom-8 right-4 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
                        <div class="absolute -bottom-8 -left-4 w-72 h-72 bg-secondary-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
                    </div>
                    <div class="mt-8 text-center">
                        <h3 class="text-2xl font-bold text-white">Système de Gestion Hôtelière</h3>
                        <p class="mt-4 text-lg text-white opacity-90">Gérez votre établissement en toute simplicité</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles pour l'animation -->
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</x-auth-layout>
