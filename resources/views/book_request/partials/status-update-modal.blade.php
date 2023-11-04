<x-modal name="status-update-override-{{ $bookRequest->id }}" focusable>
    <form method="post" action="{{ route('request.status.update', $bookRequest) }}" class="p-6">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to update this request?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("This request is already been {$bookRequest->status}. Please Enter Your Password To Confirm You Would Like To Update The Status Of This Request.") }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="remarks" value="{{ __('Remarks') }}" class="sr-only" />

            <x-text-input id="remarks" name="remarks" type="text" class="mt-1 block w-3/4"
                placeholder="{{ __('Remarks (optional)') }}" />

            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            @if ($bookRequest->status == 'denied' || $bookRequest->status == 'cancelled')
                <input type="hidden" name="status" value="approved">
                <x-danger-button class="ml-3">
                    {{ __('Approve') }}
                </x-danger-button>
            @else
                <input type="hidden" name="status" value="denied">
                <x-danger-button class="ml-3">
                    {{ __('Denied') }}
                </x-danger-button>
            @endif
        </div>
    </form>
</x-modal>

@if ((session('bookReqStatus') == $bookRequest->id))
<x-modal name="status-update-override-" :show="$errors->isNotEmpty" focusable>
    <form method="post" action="{{ route('request.status.update', $bookRequest) }}" class="p-6">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to update this request?') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("This request is already been {$bookRequest->status}. Please Enter Your Password To Confirm You Would Like To Update The Status Of This Request.") }}
        </p>

        <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="remarks" value="{{ __('Remarks') }}" class="sr-only" />

            <x-text-input id="remarks" name="remarks" type="text" class="mt-1 block w-3/4"
                placeholder="{{ __('Remarks (optional)') }}" />

            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            @if ($bookRequest->status == 'denied' || $bookRequest->status == 'cancelled')
                <input type="hidden" name="status" value="approved">
                <x-danger-button class="ml-3">
                    {{ __('Approve') }}
                </x-danger-button>
            @else
                <input type="hidden" name="status" value="denied">
                <x-danger-button class="ml-3">
                    {{ __('Denied') }}
                </x-danger-button>
            @endif
        </div>
    </form>
</x-modal>
@endif
