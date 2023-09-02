<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('user.accounts') }}">
        {{ __('Users Accounts |') }}
    </a>
    

    <x-nav-link :href="route('user.create')" :active="request()->routeIs('user.create')">
        {{ __('Add New User') }}
    </x-nav-link>
    
</h2>