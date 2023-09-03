<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('book.index') }}">
        {{ __('Books |') }}
    </a>

    <x-nav-link :href="route('book.create')" :active="request()->routeIs('book.create')">
        {{ __('Add New Book') }}
    </x-nav-link>
</h2>