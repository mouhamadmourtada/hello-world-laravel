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
                        Créer un compte
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Ou
                        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                            connectez-vous à votre compte existant
                        </a>
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                    @csrf
                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nom
                            </label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                                    value="{{ old('name') }}" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Adresse email
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out"
                                    value="{{ old('email') }}" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Mot de passe
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Confirmer le mot de passe
                            </label>
                            <div class="mt-1">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-xl shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 transition duration-150 ease-in-out" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition duration-150 ease-in-out">
                                S'inscrire
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
                        <p class="mt-4 text-lg text-white opacity-90">Rejoignez-nous pour gérer votre établissement</p>
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
