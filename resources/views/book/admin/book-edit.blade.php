<x-app-layout>
    @section('title', 'Add Book')
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.partials.message-status')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Book Details') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update book details.') }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('book.cover', $book) }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <!-- Book Cover -->
                            <div class="relative">
                                <x-input-label for="cover" :value="__('Change Book Cover')" />
                                <x-text-input id="cover" name="cover" type="file"
                                    class="mt-1 block w-full p-4 pl-4 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none "
                                    :value="old('cover')" autofocus autocomplete="cover" required />
                                <button type="submit"
                                    class="absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                        </form>

                        @if ($book->cover != null or $book->cover != '')
                            <div class="mt-5">
                                <a class="center" href="{{ asset('storage/book_cover/' . $book->cover) }}"
                                    target="_blank"><img src="{{ asset('storage/book_cover/' . $book->cover) }}"
                                        style="width:30%; height:30%" /></a>
                            </div>
                        @else
                            <div class="mt-5">
                                <img src="{{ asset('storage/book_cover/no_image.jpg') }}"
                                    style="width:20%; height:20%" />
                            </div>
                        @endif

                        <form method="post" action="{{ route('book.update', $book, $book->bookLocation) }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <!-- Book Title -->
                            <div>
                                <x-input-label for="title" :value="__('Book Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    :value="old('title', $book->title)" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <!-- Book Author -->
                            <div>
                                <x-input-label for="author" :value="__('Book Author')" />
                                <x-text-input id="author" name="author" type="text" list="authors"
                                    class="mt-1 block w-full" :value="old('author', $book->author->name)" required autofocus
                                    autocomplete="author" />
                                <datalist id="authors">
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->name }}">
                                    @endforeach
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('author')" />
                            </div>

                            <!-- Book ISBN -->
                            <div>
                                <x-input-label for="isbn" :value="__('Book ISBN')" />
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full"
                                    :value="old('isbn', $book->isbn)" required autofocus autocomplete="isbn" />
                                <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                            </div>

                            <!-- Book Publisher -->
                            <div>
                                <x-input-label for="publisher" :value="__('Book Publisher')" />
                                <x-text-input id="publisher" name="publisher" type="text" list="publishers"
                                    class="mt-1 block w-full" :value="old('publisher', $book->publisher->name)" required autofocus
                                    autocomplete="publisher" />
                                <datalist id="publishers">
                                    @foreach ($publishers as $publisher)
                                        <option value="{{ $publisher->name }}">
                                    @endforeach
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                            </div>

                            <!-- Book Publication Year -->
                            <div>
                                <x-input-label for="publication_year" :value="__('Book Publication Year')" />
                                <x-text-input id="publication_year" name="publication_year" type="text"
                                    class="mt-1 block w-full" :value="old('publication_year', $book->publication_year)" required autofocus
                                    autocomplete="publication_year" />
                                <x-input-error class="mt-2" :messages="$errors->get('publication_year')" />
                            </div>

                            <!-- Add Book Category -->
                            <div>
                                <x-input-label for="category" :value="__('Add Book Category')" />
                                <x-text-input id="category" name="category" type="text" list="categories"
                                    class="mt-1 block w-full" :value="old('category')" autofocus autocomplete="category" />
                                <datalist id="categories">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->name }}">
                                    @endforeach
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>

                            <!-- Book Categories -->
                            <div>
                                <x-input-label class="mb-2" :value="__('Book Category')" />
                                <div class="flex flex-wrap items-center">
                                    @foreach ($book->bookCategories as $bookCategory)
                                        <a class="mt-2 mx-1 p-2 text-sm bg-blue-500 whitespace-nowrap no-underline hover:underline rounded hover:bg-red-800"
                                            href="{{ route('bookCategory.destroy', $bookCategory) }}">
                                            {{ $bookCategory->category->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Book Copies -->
                            <div>
                                <x-input-label for="copies" :value="__('Book Copies')" />
                                <x-text-input id="copies" name="copies" type="text" class="mt-1 block w-full"
                                    :value="old('copies', $book->copies)" required autofocus autocomplete="copies" />
                                <x-input-error class="mt-2" :messages="$errors->get('copies')" />
                            </div>

                            <div>
                                <x-input-label :value="__('Status')" />
                                <input type="radio" id="available" name="status" value="available"
                                    {{ $book->status == 'available' ? 'checked' : '' }}> Available </label>

                                <input type="radio" id="unavailable" name="status" value="unavailable"
                                    {{ $book->status == 'unavailable' ? 'checked' : '' }}> Unavailable/Out Of Order</label>
                            </div>

                            @foreach ($book->bookLocations as $bookLocation)
                                <!-- Book Call Number -->
                                <div>
                                    <x-input-label for="call_number" :value="__('Call Number')" />
                                    <x-text-input id="call_number" name="call_number" type="text"
                                        class="mt-1 block w-full" :value="old('call_number', $bookLocation->call_number)" autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('call_number')" />
                                </div>

                                <!-- Book Floor Number -->
                                <div>
                                    <x-input-label for="floor" :value="__('Floor Number')" />
                                    <x-text-input id="floor" name="floor" type="text"
                                        class="mt-1 block w-full" :value="old('floor', $bookLocation->floor)"  autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('floor')" />
                                </div>

                                <!-- Book Shelf Number -->
                                <div>
                                    <x-input-label for="shelf" :value="__('Shelf Number')" />
                                    <x-text-input id="shelf" name="shelf" type="text"
                                        class="mt-1 block w-full" :value="old('shelf', $bookLocation->shelf)" autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('shelf')" />
                                </div>
                            @endforeach

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>

            <div class="mt-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section class="space-y-6">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Delete Book') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Once this book is deleted, all of its resources and data will be permanently deleted. Before deleting this book, please download any data or information that you wish to retain.') }}
                            </p>
                        </header>
                        <x-danger-button x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'confirm-book-deletion-{{ $book->id }}')">{{ __('Delete Book') }}</x-danger-button>
                        @include('book.partials.book-delete')
                    </section>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
