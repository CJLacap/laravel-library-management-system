<!-- Navigation Admin Links -->

@if(Auth::user()->role === 'admin')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link  :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('librarian.accounts')" :active="request()->routeIs('librarian.accounts')">
            {{ __('Librarians') }}
        </x-nav-link>
    </div>
@endif


<!-- Navigation Librarian Links -->

@if(Auth::user()->role === 'librarian')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('librarian.dashboard')" :active="request()->routeIs('librarian.dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>
@endif


<!-- Navigation Admin || Librarian Links -->

@if((Auth::user()->role == 'admin') or (Auth::user()->role == 'librarian'))
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('user.accounts')" :active="request()->routeIs('user.accounts')">
            {{ __('Users') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('book.index')" :active="request()->routeIs('book.index')">
            {{ __('Books') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('request.index')" :active="request()->routeIs('request.index')">
            {{ __('Requests') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('borrowed.index')" :active="request()->routeIs('borrowed.index')">
            {{ __('Borrowed') }}
        </x-nav-link>
    </div>

    
@endif


<!-- Navigation User Links -->
                    
@if(Auth::user()->role === 'user')
    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('user.books')" :active="request()->routeIs('user.books')">
            {{ __('Books') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('user.requests')" :active="request()->routeIs('user.requests')">
            {{ __('Requests') }}
        </x-nav-link>
    </div>

    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
        <x-nav-link :href="route('user.borrowed')" :active="request()->routeIs('user.borrowed')">
            {{ __('Borrowed Books') }}
        </x-nav-link>
    </div>
   
@endif






