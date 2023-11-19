<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('borrowed.index') }}">
        {{ __('Borrowed Books |') }}
    </a>

    <x-nav-link :href="route('borrowed')" :active="request()->routeIs('borrowed')">
        {{ __('Borrrowed') }}
    </x-nav-link>

    <x-nav-link :href="route('returned')" :active="request()->routeIs('returned')">
        {{ __('Returned') }}
    </x-nav-link>

   
</h2>