<x-modal name="confirm-borrowed-deletion-{{ $borrowBook->id }}" focusable>
    <form method="post" action="{{ route('borrowed.destroy', $borrowBook) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to delete this book borrowed data?') }}
       
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once this book borrowed is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this book borrowed.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Delete') }}
            </x-danger-button>
        </div>
       
    </form>
</x-modal>


@if ((session('bb') == $borrowBook->id))
<x-modal name="confirm-borrowed-deletion-" :show="$errors->isNotEmpty" focusable>
    <form method="post" action="{{ route('borrowed.destroy', $borrowBook) }}" class="p-6">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to delete this book borrowed?') }}
       
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once this book borrowed is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete this book borrowed.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                {{ __('Delete') }}
            </x-danger-button>
        </div>
    </form>
</x-modal>
@endif 


