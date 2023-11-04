<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    <a href="{{ route('user.requests') }}">
        {{ __('Requests |') }}
    </a>
    
    <x-nav-link :href="route('user.request.pending')" :active="request()->routeIs('user.request.pending')">
        {{ __('Pending') }}
    </x-nav-link>

    <x-nav-link :href="route('user.request.approved')" :active="request()->routeIs('user.request.approved')">
        {{ __('Approved') }}
    </x-nav-link>

    <x-nav-link :href="route('user.request.cancelled')" :active="request()->routeIs('user.request.cancelled')">
        {{ __('Cancelled/Denied') }}
    </x-nav-link>
    
</h2>