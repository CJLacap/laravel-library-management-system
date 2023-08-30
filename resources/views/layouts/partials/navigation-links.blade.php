  <!-- Navigation Admin Links -->

@if(Auth::user()->role === 'admin')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link  :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('librarian.accounts')" :active="request()->routeIs('librarian.accounts')">
            {{ __('Librarian Accounts') }}
        </x-nav-link>
    </div>

    <!-- Navigation Librarian Links -->

    @elseif(Auth::user()->role === 'librarian')
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('librarian.dashboard')" :active="request()->routeIs('librarian.dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>

    <!-- Navigation User Links -->
                    
    @else
        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        </div>
@endif