<!-- Hero Section avec Slider -->
<div x-data="{ currentSlide: 0 }" class="relative overflow-hidden bg-gray-900">
    <!-- Slides -->
    <div class="relative h-screen">
        <!-- Slide 1 -->
        <div x-show="currentSlide === 0" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="absolute inset-0">
            <img src="https://i.pinimg.com/originals/3d/65/98/3d6598f418272467bfe4d184adeb399d.jpg" class="object-cover w-full h-full" alt="Luxurious Hotel Room">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">Bienvenue au Paradise Hotel</h1>
                    <p class="text-xl md:text-2xl mb-8">Découvrez le luxe et le confort à son apogée</p>
                    <a href="#reservations" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                        Réserver maintenant
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div x-show="currentSlide === 1"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="absolute inset-0">
            <img src="https://th.bing.com/th/id/R.a4c6db478ca084471ef2bdab57968845?rik=%2bybAS10h%2bFSUbA&pid=ImgRaw&r=0" class="object-cover w-full h-full" alt="Luxury Pool">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">Une Expérience Unique</h1>
                    <p class="text-xl md:text-2xl mb-8">Des moments inoubliables dans un cadre exceptionnel</p>
                    <a href="#services" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                        Découvrir nos services
                    </a>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div x-show="currentSlide === 2"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-x-full"
             x-transition:enter-end="opacity-100 transform translate-x-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-x-0"
             x-transition:leave-end="opacity-0 transform -translate-x-full"
             class="absolute inset-0">
            <img src="https://images.pexels.com/photos/1134176/pexels-photo-1134176.jpeg?cs=srgb&dl=dug-out-pool-hotel-poolside-1134176.jpg&fm=jpg" class="object-cover w-full h-full" alt="Gourmet Restaurant">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="text-center text-white px-4">
                    <h1 class="text-5xl md:text-6xl font-bold mb-4">Gastronomie d'Exception</h1>
                    <p class="text-xl md:text-2xl mb-8">Une cuisine raffinée pour ravir vos papilles</p>
                    <a href="#restaurant" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-full transition duration-300">
                        Explorer notre menu
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Buttons -->
    <div class="absolute bottom-5 left-0 right-0 flex justify-center space-x-4">
        <button @click="currentSlide = 0" :class="{ 'bg-white': currentSlide === 0, 'bg-gray-400': currentSlide !== 0 }" class="w-3 h-3 rounded-full transition-all duration-300"></button>
        <button @click="currentSlide = 1" :class="{ 'bg-white': currentSlide === 1, 'bg-gray-400': currentSlide !== 1 }" class="w-3 h-3 rounded-full transition-all duration-300"></button>
        <button @click="currentSlide = 2" :class="{ 'bg-white': currentSlide === 2, 'bg-gray-400': currentSlide !== 2 }" class="w-3 h-3 rounded-full transition-all duration-300"></button>
    </div>

    <!-- Previous/Next Buttons -->
    <button @click="currentSlide = currentSlide === 0 ? 2 : currentSlide - 1" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
    </button>
    <button @click="currentSlide = currentSlide === 2 ? 0 : currentSlide + 1" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-75 transition-all duration-300">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
    </button>
</div>

<!-- Auto-advance slides -->
<script>
    setInterval(function() {
        if (document.querySelector('[x-data]').__x) {
            document.querySelector('[x-data]').__x.$data.currentSlide = 
                (document.querySelector('[x-data]').__x.$data.currentSlide + 1) % 3;
        }
    }, 5000);
</script>
