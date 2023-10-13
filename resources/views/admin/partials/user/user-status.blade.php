<section class="space-y-6">
    
    @if($user->status == 'active')
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Block This Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this account is blocked, This account will no longer be able to login to this web application.') }}
            </p>
        
        </header>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-block')"
        >{{ __('Block Account') }}</x-danger-button>


        <x-modal name="confirm-user-block" :show="$errors->userStatus->isNotEmpty()" focusable>
            <form method="post" action="{{ route('user.status', $user) }}" class="p-6">
                @csrf
                @method('patch')

                <input type="hidden" value="blocked" name="status">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to block this account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once this account is blocked, This account will no longer be able to login to this web application. Please enter your password to confirm you would like to block this account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input-error :messages="$errors->userStatus->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Block Account') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    @endif


    @if($user->status == 'blocked' or $user->status == 'inactive')
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Reactivate This Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once this account is reactivated, This account will be able to login to this web application.') }}
            </p>
        
        </header>

        <x-green-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-reactivate')"
        >{{ __('Reactivate Account') }}</x-green-button>

        <x-modal name="confirm-user-reactivate" :show="$errors->userStatus->isNotEmpty()" focusable>
            <form method="post" action="{{ route('user.status', $user) }}" class="p-6">
                @csrf
                @method('patch')

                <input type="hidden" value="active" name="status">

                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Are you sure you want to reactivate this account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once this account is reactivate, This account will be able to login to this web application. Please enter your password to confirm you would like to reactivate this account.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Password') }}"
                    />

                    <x-input-error :messages="$errors->userStatus->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-green-button class="ml-3">
                        {{ __('Reactivate Account') }}
                    </x-green-button>
                </div>
            </form>
        </x-modal>
    @endif
</section>
