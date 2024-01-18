
<x-modal name="book-borrow-{{ $book->id }}" focusable>
    <form method="post" action="{{ route('book.borrowed.store', $book) }}" class="p-6">
        @csrf
        @method('post')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Proceed To Borrow This Book") }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Please Fill Up The Information Needed Below To Borrow This Book.") }}
            <br/>
            {{ __("Title: {$book->title}") }}
        </p>
        <div class="mt-6">
            <x-input-label for="user-{{ $book->id }}" :value="__('User Email')" />
            <x-text-input id="user-{{ $book->id }}" name="user" type="text" list="users" class="mt-1 block w-3/4" :value="old('user')"
            placeholder="{{ __('Input/Select User Email') }}" autofocus autocomplete="user" />
            <datalist id="users">
                @foreach ($users as $user )
                    <option value="{{ $user->email}}">
                @endforeach
            </datalist>
            <x-input-error class="mt-2" :messages="$errors->get('user')" />
        </div>

        <div class="mt-6">
            <x-input-label for="return_date-{{ $book->id }}" :value="__('Return Date ')" />
            <x-text-input id="return_date-{{ $book->id }}" name="return_date" type="date" class="mt-1 block w-3/4  dark:text-white dark:[color-scheme:dark]" required autofocus/>
            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="remarks-{{ $book->id }}" value="{{ __('Remarks') }}"  />
            <x-text-input id="remarks-{{ $book->id }}" name="remarks" type="text" class="mt-1 block w-3/4"
                placeholder="{{ __('Remarks (optional)') }}" />
            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                    {{ __('Proceed') }}
            </x-danger-button>

        </div>
    </form>
</x-modal>
@if((session('bookBorrow') == $book->id))
<x-modal name="book-borrow-"  :show="$errors->isNotEmpty" focusable>
    <form method="post" action="{{ route('book.borrowed.store', $book) }}" class="p-6">
        @csrf
        @method('post')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __("Proceed To Borrow This Book") }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Please Fill Up The Information Needed Below To Borrow This Book.") }}
            <br/>
            {{ __("Title: {$book->title}") }}
        </p>
        <div class="mt-6">
            <x-input-label for="user" :value="__('User Email')" />
            <x-text-input id="user" name="user" type="text" list="users" class="mt-1 block w-3/4" :value="old('user')"
            placeholder="{{ __('Input/Select User Email') }}" required autofocus autocomplete="user" />
            <datalist id="users">
                @foreach ($users as $user )
                    <option value="{{ $user->email}}">
                @endforeach
            </datalist>
            <x-input-error class="mt-2" :messages="$errors->get('user')" />
        </div>

        <div class="mt-6">
            <x-input-label for="return_date" :value="__('Return Date ')" />
            <x-text-input id="return_date" name="return_date" type="date" class="mt-1 block w-3/4  dark:text-white dark:[color-scheme:dark]"/>
            <x-input-error :messages="$errors->get('return_date')" class="mt-2" />
        </div>

        <div class="mt-6">
            <x-input-label for="remarks" value="{{ __('Remarks') }}"  />
            <x-text-input id="remarks" name="remarks" type="text" class="mt-1 block w-3/4"
                placeholder="{{ __('Remarks (optional)') }}" />
            <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ml-3">
                    {{ __('Proceed') }}
            </x-danger-button>

        </div>
    </form>
</x-modal>
@endif
