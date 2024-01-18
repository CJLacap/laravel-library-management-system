<x-app-layout>
    @section('title', 'Books')
    <x-slot name="header">
       @include('book.partials.user.book-header')
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" text-gray-900 dark:text-gray-100">
                <h3 class="text-white">Search Books</h3>
                <form method="get" action="" class="py-6">
                    @csrf
                    @method('get')
                    <label for="search"
                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="search" id="search" name="search"
                            class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Book" required>
                        <button type="submit"
                            class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </div>
                </form>

                @include('layouts.partials.message-status')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 text-gray-900 dark:text-gray-100">
                        <div>
                            <p class="text-sm text-white-700 leading-5">
                                {!! __('Showing') !!}
                                @if ($books->firstItem())
                                    <span class="font-medium">{{ $books->firstItem() }}</span>
                                    {!! __('to') !!}
                                    <span class="font-medium">{{ $books->lastItem() }}</span>
                                @else
                                    {{ $books->count() }}
                                @endif
                                {!! __('of') !!}
                                <span class="font-medium">{{ $books->total() }}</span>
                                {!! __('results') !!}
                            </p>
                        </div>
                        <div class="container mx-auto mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($books as $book)
                            <div class="flex flex-col h-full bg-white rounded-lg overflow-hidden">
                                <!-- Book Card -->
                                <div class="flex-1">
                                    @if ($book->cover != null or $book->cover != '')
                                    <img src="{{ asset('storage/book_cover/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-96 object-fit">
                                    @else
                                    <img src="{{ asset('storage/book_cover/no_image.jpg') }}" alt="{{ $book->title }}" class="w-full object-contain ">
                                    @endif
                                    <div class="p-4">
                                        <h2 class="text-xl text-gray-600 font-bold mb-2">{{ $book->title }}</h2>
                                        <p class="text-gray-700 text-md mb-2">Author: <span class="text-gray-700 font-bold">{{ $book->author->name }}</span> </p>
                                    </div>
                                </div>

                                <!-- Button at the Same Position -->
                                <div class="p-3 text-white flex flex-row justify-end">
                                    <a href="{{ route('user.showBook', $book) }}" class="rounded-full px-6 mx-3 py-3 bg-blue-600 hover:bg-blue-700 text-right">
                                        View
                                    </a>
                                    <form method= "POST" action="{{ route('user.storeRequest', $book) }}">
                                        @csrf
                                        @method('POST')
                                    <button class="rounded-full px-6 py-3 bg-blue-600 hover:bg-blue-700">Reserve</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class="mx-auto max-w-lg pt-6 p-4">
                            {{ $books->Links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
</x-app-layout>
