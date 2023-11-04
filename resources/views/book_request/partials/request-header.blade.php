<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('request.index') }}">
        {{ __('Book Requests |') }}
    </a>

    <x-nav-link :href="route('pending')" :active="request()->routeIs('pending')">
        {{ __('Pending') }}
    </x-nav-link>

    <x-nav-link :href="route('approved')" :active="request()->routeIs('approved')">
        {{ __('Approved') }}
    </x-nav-link>

    <x-nav-link :href="route('cancelled')" :active="request()->routeIs('cancelled')">
        {{ __('Cancelled/Denied') }}
    </x-nav-link>
</h2>