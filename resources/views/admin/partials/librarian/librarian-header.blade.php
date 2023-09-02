<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('librarian.accounts') }}">
        {{ __('Librarian Accounts |') }}
    </a>

    <x-nav-link :href="route('librarian.create')" :active="request()->routeIs('librarian.create')">
        {{ __('Add New Librarian') }}
    </x-nav-link>
</h2>