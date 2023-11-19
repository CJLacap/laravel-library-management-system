<nav x-data="{ open: false }" class="fixed inset-x-0 top-0 z-10 w-full px-4 py-1 bg-gray-900 transition duration-700 ease-out">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between p-4">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <div class="text-[2rem] leading-[3rem] tracking-tight font-bold text-black dark:text-white">
                        <div class=" flex flex-wrap">
                            <a href="{{ route('home') }}">
                                 <img class="w-20 h-10" src="{{ asset('storage/logo.png') }}"/></a>
                                <a href="{{ route('home') }}">LM<span class="text-sky-500">&</span>RS</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Links -->
            <div class=" hidden sm:flex sm:items-center sm:ml-6 text-gray-200 ">
              
                <div class="items-center space-x-4 text-lg font-semibold tracking-tight hidden sm:-my-px sm:ml-10 sm:flex hover:text-sky-600">
                    <a href="{{ route('home') }}">
                        {{ __('Home') }}
                    </a>
                </div>

                <div class="items-center space-x-4 text-lg font-semibold tracking-tight hidden sm:-my-px sm:ml-10 sm:flex hover:text-sky-600">
                    <a href="{{ route('home.books') }}">
                        {{ __('Books') }}
                    </a>
                </div>
                <div class="items-center space-x-4 text-lg  font-semibold tracking-tight hidden sm:-my-px sm:ml-10 sm:flex hover:text-sky-600">
                    <a href="{{ route('home.aboutUs') }}">
                        {{ __('About Us') }}
                    </a>
                </div>
                <div class="items-center space-x-4 text-lg font-semibold tracking-tight hidden sm:-my-px sm:ml-10 sm:flex hover:text-sky-600">
                    <a href="{{ route('home.contactUs') }}">
                        {{ __('Contact Us') }}
                    </a>
                </div>
            </div>
           
         
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="items-center space-x-4 text-lg font-semibold tracking-tight hidden sm:-my-px sm:ml-10 sm:flex">
                    @if (Route::has('login'))
                    @auth
                    <button
                        class="px-6 py-2 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black"
                        onclick="window.location='{{ url('/dashboard') }}'">
                        Dashboard</button>
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                            <button
                            class="px-6 py-2 text-white transition duration-500 ease-out bg-blue-700 rounded-lg hover:bg-blue-800 hover:ease-in hover:underline"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Sign out</button>
                        </form>
                    @else
                    <button
                        class="px-6 py-2 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black"
                        onclick="window.location='{{ route('login') }}'">
                        Sign in</button>
                    <button
                        class="px-6 py-2 text-white transition duration-500 ease-out bg-blue-700 rounded-lg hover:bg-blue-800 hover:ease-in hover:underline"
                        onclick="window.location='{{ route('register') }}'">
                        Sign up</button>
                    @endauth
                    @endif
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link   :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link >
        </div>
        <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link   :href="route('home')" :active="request()->routeIs('home.books')">
                    {{ __('Books') }}
                </x-responsive-nav-link >
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link   :href="route('home')" :active="request()->routeIs('pending')">
                {{ __('About Us') }}
            </x-responsive-nav-link >
        </div>
        <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link   :href="route('home')" :active="request()->routeIs('pending')">
            {{ __('Contact Us') }}
        </x-responsive-nav-link >
        </div>
        

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200"></div>
                <div class="font-medium text-sm text-gray-500"></div>
            </div>

            <div class="mt-3 space-y-1">
                <div class=" flex items-center ">
                    <div class="items-center space-x-4 text-lg font-semibold tracking-tight  ">
                        @if (Route::has('login'))
                        @auth
                        <button
                            class="px-6 py-2 ml-10 mb-5 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black"
                            onclick="window.location='{{ url('/dashboard') }}'">
                            Dashboard</button>
                            <button
                            class="px-6 py-2 mb-5 mr-10 text-white transition duration-500 ease-out bg-blue-700 rounded-lg hover:bg-blue-800 hover:ease-in hover:underline"
                            onclick="window.location='{{ route('register') }}'">
                            Sign out</button>
                        @else
                        <button
                            class="px-6 py-2 ml-10 mb-5 text-black transition duration-700 ease-out bg-white border border-black rounded-lg hover:bg-black hover:border hover:text-white dark:border-white dark:bg-inherit dark:text-white dark:hover:bg-white dark:hover:text-black"
                            onclick="window.location='{{ route('login') }}'">
                            Sign in</button>
                        <button
                            class="px-6 py-2 mb-5 mr-10 text-white transition duration-500 ease-out bg-blue-700 rounded-lg hover:bg-blue-800 hover:ease-in hover:underline"
                            onclick="window.location='{{ route('register') }}'">
                            Sign up</button>
                        @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
