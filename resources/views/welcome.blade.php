<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paradise Hotel - Votre havre de luxe</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="antialiased">
    @if (Route::has('login'))
        <nav class="fixed top-0 right-0 left-0 z-50 bg-white bg-opacity-90 backdrop-blur-sm shadow-md">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-2xl font-bold text-primary-600">
                            Paradise Hotel
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-primary-600">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary-600">Se connecter</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded-full transition duration-300">S'inscrire</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <main>
        <!-- Hero Section avec Slider -->
        <x-home.hero-slider />

        <!-- Services Section -->
        <x-home.features />

        <!-- Chambres Section -->
        <x-home.rooms />

        <!-- Témoignages Section -->
        <x-home.testimonials />

        <!-- Contact Section -->
        <section class="py-20 bg-primary-600">
            <div class="container mx-auto px-4 text-center text-white">
                <h2 class="text-4xl font-bold mb-8">Réservez votre séjour de rêve</h2>
                <p class="text-xl mb-8">Contactez-nous pour plus d'informations ou pour effectuer une réservation</p>
                <div class="flex justify-center space-x-4">
                    <a href="#" class="bg-white text-primary-600 hover:bg-gray-100 px-8 py-3 rounded-full font-semibold transition duration-300">
                        Réserver maintenant
                    </a>
                    <a href="#" class="border-2 border-white text-white hover:bg-white hover:text-primary-600 px-8 py-3 rounded-full font-semibold transition duration-300">
                        Nous contacter
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Paradise Hotel</h3>
                    <p class="text-gray-400">Votre havre de paix pour des moments inoubliables.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>123 Avenue du Paradis</li>
                        <li>75000 Paris, France</li>
                        <li>Tél: +33 1 23 45 67 89</li>
                        <li>Email: contact@paradisehotel.fr</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Chambres</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Restaurant</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Spa</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Inscrivez-vous pour recevoir nos offres exclusives.</p>
                    <form class="flex">
                        <input type="email" placeholder="Votre email" class="flex-1 px-4 py-2 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-primary-600">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 px-4 py-2 rounded-r-lg transition duration-300">
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Paradise Hotel. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>
