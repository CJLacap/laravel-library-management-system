<x-dropdown align="right" width="48">
    <x-slot name="trigger">
        <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button"> 
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
            </svg>
        </button>
    </x-slot>
    <x-slot name="content">
        <x-dropdown-link :href="route('request.view', $bookRequest)">
            {{ __('View') }}
        </x-dropdown-link>

        @if($bookRequest->status == 'denied' or $bookRequest->status == 'cancelled')
        
        <x-dropdown-link :href="route('request.status.update', $bookRequest)"
        x-on:click.prevent="$dispatch('open-modal', 'status-update-override-{{ $bookRequest->id }}')">
            {{ __('Approve') }}
        </x-dropdown-link>
      

        @elseif($bookRequest->status == 'approved')
        <x-dropdown-link :href="route('borrowed.store', $bookRequest)"
        x-on:click.prevent="$dispatch('open-modal', 'request-borrow-{{ $bookRequest->id }}')">
            {{ __('Borrow') }}
        </x-dropdown-link>

        <x-dropdown-link :href="route('request.status.update', $bookRequest)"
        x-on:click.prevent="$dispatch('open-modal', 'status-update-override-{{ $bookRequest->id }}')">
            {{ __('Deny') }}
        </x-dropdown-link>

        @else
        <form method="post" action="{{ route('request.status.update', $bookRequest) }}">
            @csrf
            @method('patch')
        <x-dropdown-link :href="route('request.status.update', $bookRequest)"
            onclick="event.preventDefault();
            this.closest('form').submit();">
              <input type="hidden" name="status" value="approved">
            {{ __('Approve') }}
        </x-dropdown-link>
        </form>

        <form method="post" action="{{ route('request.status.update', $bookRequest) }}">
            @csrf
            @method('patch')
        <x-dropdown-link :href="route('request.status.update', $bookRequest)"
            onclick="event.preventDefault();
            this.closest('form').submit();">
              <input type="hidden" name="status" value="denied">
            {{ __('Deny') }}
        </x-dropdown-link>
        </form>

        @endif

        <x-dropdown-link :href="route('request.destroy', $bookRequest)"
        x-on:click.prevent="$dispatch('open-modal', 'confirm-request-deletion-{{ $bookRequest->id }}')">
            {{ __('Delete') }}
        </x-dropdown-link>

    </x-slot>                                               
</x-dropdown>

