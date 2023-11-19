<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('user.borrowed') }}">
        {{ __('Borrowed Books |') }}
    </a>
    
    <x-nav-link :href="route('user.borrowed.borrowed')" :active="request()->routeIs('user.borrowed.borrowed')">
        {{ __('Borrowed') }}
    </x-nav-link>

    <x-nav-link :href="route('user.borrowed.returned')" :active="request()->routeIs('user.borrowed.returned')">
        {{ __('Returned') }}
    </x-nav-link>
</h2>