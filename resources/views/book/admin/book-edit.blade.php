<x-app-layout>
    @section('title', 'Add Book')
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

                            @if ($book->cover != null or $book->cover != '')
                                <div class="">
                                    <a class="center" href="{{ asset('storage/book_cover/' . $book->cover) }}"
                                        target="_blank"><img src="{{ asset('storage/book_cover/' . $book->cover) }}"
                                            style="width:30%; height:30%" /></a>
                                </div>
                            @else
                                <div class="">
                                    <img src="{{ asset('storage/book_cover/no_image.jpg') }}"
                                        style="width:20%; height:20%" />
                                </div>
                            @endif
                        </form>


                        <form method="post" action="" class="mt-6 space-y-6" enctype="multipart/form-data">
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
                                        <option value="{{ $author->name}}">
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
                                        <option value="{{ $publisher->name}}">
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

                            {{-- <!-- Book Category -->
                            <div>
                                <x-input-label for="category" :value="__('Book Category')" />
                                <x-text-input id="isbn" name="category" type="text" list="categories"
                                    class="mt-1 block w-full" :value="old('category')" required autofocus
                                    autocomplete="category" />
                                <datalist id="categories">
                                    <option value="1">
                                    <option value="2">
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div> --}}

                            <!-- Book Copies -->
                            <div>
                                <x-input-label for="copies" :value="__('Book Copies')" />
                                <x-text-input id="copies" name="copies" type="text" class="mt-1 block w-full"
                                    :value="old('copies', $book->copies)" required autofocus autocomplete="copies" />
                                <x-input-error class="mt-2" :messages="$errors->get('copies')" />
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Update') }}</x-primary-button>

                                @if (session('status') === 'book-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Book Updated Successfully.') }}</p>
                                @endif
                                @if (session('status') === 'book-cover-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ __('Book Cover Updated Successfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
