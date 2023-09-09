<x-app-layout>
    @section('title', 'Author: '.$author->name)
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Author Details') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update Author details.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('author.edit', $author) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <!-- Author Name -->
                            <div>
                                <x-input-label for="name" :value="__('Author Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    :value="old('name', $author->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                @if (session('status') === 'author-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Author Updated Successfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
