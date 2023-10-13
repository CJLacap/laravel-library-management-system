<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('book.index') }}">
        {{ __('Books |') }}
    </a>

    <x-nav-link :href="route('book.create')" :active="request()->routeIs('book.create')">
        {{ __('Add New Book') }}
    </x-nav-link>

    <x-nav-link :href="route('book.authors')" :active="request()->routeIs('book.authors')">
        {{ __('Authors') }}
    </x-nav-link>
    <x-nav-link :href="route('book.publishers')" :active="request()->routeIs('book.publishers')">
        {{ __('Publishers') }}
    </x-nav-link>
    <x-nav-link :href="route('book.categories')" :active="request()->routeIs('book.categories')">
        {{ __('Categories') }}
    </x-nav-link>
</h2>