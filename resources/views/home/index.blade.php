<x-home-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-16">

                <!-- Hero Section -->
                <header class="bg-gray-800 text-white h-96 flex items-center justify-center rounded-md">
                    <div class="text-center">
                        <h1 class="text-4xl font-bold mb-4">Laravel Library Management & Reseravation</h1>
                        <p class="text-lg mb-6">Discover a seamless way to manage your library resources and
                            reservations.</p>
                        <a href="#features" class="bg-blue-500 text-white px-6 py-3 rounded-full hover:bg-blue-700">Learn
                            More</a>
                    </div>
                </header>

                <!-- Features Section -->
                <section id="features" class="container mx-auto my-8 p-4">
                    <h2 class="text-2xl font-bold mb-4 dark:text-white">Key Features</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Feature 1 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold mb-2">Effortless Management</h3>
                            <p class="text-gray-700">Simplify day-to-day tasks with our intuitive management tools for
                                librarians.</p>
                        </div>
                        <!-- Feature 2 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold mb-2">Seamless Reservations</h3>
                            <p class="text-gray-700">Enable patrons to reserve books online, ensuring they get what they
                                want when they want it.</p>
                        </div>
                        <!-- Feature 3 -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-bold mb-2">Real-time Availability</h3>
                            <p class="text-gray-700">Keep everyone in the loop with real-time updates on book
                                availability.</p>
                        </div>
                    </div>
                </section>

                <!-- Get Started Section -->
                <section class="bg-blue-500 text-white py-16 rounded-md">
                    <div class="container mx-auto text-center">
                        <h2 class="text-3xl font-bold mb-4">Get Started Today</h2>
                        <p class="text-lg mb-6">Join us in revolutionizing library management. Sign up now and
                            experience the difference.</p>
                        <a href="{{ route('register') }}" class="bg-white text-blue-500 px-6 py-3 rounded-full hover:bg-gray-100">Sign
                            Up</a>
                    </div>
                </section>


            </div>
        </div>
    </div>
</x-home-layout>
