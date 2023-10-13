<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('request.index') }}">
        {{ __('User Requests |') }}
    </a>

    <x-nav-link :href="route('librarian.create')" :active="request()->routeIs('librarian.create')">
        {{ __('Pending') }}
    </x-nav-link>

    <x-nav-link :href="route('librarian.create')" :active="request()->routeIs('librarian.create')">
        {{ __('Approved') }}
    </x-nav-link>

    <x-nav-link :href="route('librarian.create')" :active="request()->routeIs('librarian.create')">
        {{ __('Denied') }}
    </x-nav-link>
</h2>