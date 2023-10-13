<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('user.requests') }}">
        {{ __('Requests |') }}
    </a>
    
    <x-nav-link :href="route('request.pending')" :active="request()->routeIs('request.pending')">
        {{ __('Pending') }}
    </x-nav-link>

    <x-nav-link :href="route('request.approved')" :active="request()->routeIs('request.approved')">
        {{ __('Approved') }}
    </x-nav-link>

    <x-nav-link :href="route('request.cancelled')" :active="request()->routeIs('request.cancelled')">
        {{ __('Cancelled/Denied') }}
    </x-nav-link>
    
</h2>