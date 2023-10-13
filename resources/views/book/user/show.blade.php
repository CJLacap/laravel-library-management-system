<x-app-layout>
    @section('title', 'Books')
    <x-slot name="header">
        @include('book.partials.user.book-header')
    </x-slot>
    
    <div class="py-6">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('book.partials.user.message')
            <div class=" text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900 dark:text-gray-100">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col md:flex-row -mx-4">
                                <div class="md:flex-1 px-4">
                                    <div class="h-[460px] rounded-lg bg-gray-300 mb-4">
                                        @if ($book->cover != null or $book->cover != '')
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/' . $book->cover) }}"
                                                alt="Book Image">
                                        @else
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/no_image.jpg') }}"
                                                alt="Book Image">
                                        @endif
                                    </div>
                                    <div class="flex -mx-2 mb-4">
                                        <div class="w-1/2 px-2">
                                            <form method= "POST" action="{{ route('user.storeRequest', $book) }}">
                                                @csrf
                                                @method('POST')
                                            <button
                                                class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700">
                                                Reserve</button>
                                            </form>
                                        </div>
                                        <div class="w-1/2 px-2">
                                            <button
                                                class="w-full bg-gray-400 text-gray-800 py-2 px-4 rounded-full font-bold hover:bg-gray-300">Add
                                                to Wishlist</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:flex-1 px-4">
                                    <h2 class="text-2xl font-bold mb-2">{{ $book->title }}</h2>
                                    <p class="text-gray-300 text-sm mb-4">Author: {{ $book->author->name }}</p>
                                    <div class="flex mb-4">
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500">Copies:</span>
                                            <span class="text-gray-300 capitalize">{{ $book->copies }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">Availability:</span>
                                            <span class="text-gray-300 capitalize">{{ $book->status }}</span>
                                        </div>
                                    </div>  
                                    <div class="mb-4">
                                        <div class="mb-1">
                                            <span class="font-bold text-gray-500">Publisher:</span>
                                            <span class="text-gray-300 capitalize">{{ $book->publisher->name }}</span>
                                        </div>
                                        <div class="mb-1">
                                            <span class="font-bold text-gray-500 ">Publication Date:</span>
                                            <span class="text-gray-300 capitalize">{{ $book->publication_year }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">ISBN:</span>
                                            <span class="text-gray-300 capitalize">{{ $book->isbn }}</span>
                                        </div>
                                        
                                    </div>
                                   

                                    <div class="mb-4">
                                        <span class="font-bold text-gray-500">Book Categories:</span>
                                        <div class="flex items-center mt-2">
                                            @foreach ($book->bookCategories as $bookCategory)
                                                <button
                                                    class="bg-gray-300 text-gray-700 py-2 px-4 rounded-full font-bold mr-2 hover:bg-gray-400">{{ $bookCategory->category->name }}</button>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div >
                                        <span class="font-bold text-gray-500">Book Location:</span>
                                        <div class="mr-4">
                                            <div class="mt-1 mb-1">
                                                <span class="font-bold text-gray-500">Call Number:</span>
                                                <span class="text-gray-300 capitalize">{{ $book->copies }}</span>
                                            </div>
                                            <div class="mb-1">
                                                <span class="font-bold text-gray-500">Floor Number:</span>
                                                <span class="text-gray-300 capitalize">{{ $book->copies }}</span>
                                            </div>
                                            <div >
                                                <span class="font-bold text-gray-500">Shelf Number:</span>
                                                <span class="text-gray-300 capitalize">{{ $book->copies }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</x-app-layout>
