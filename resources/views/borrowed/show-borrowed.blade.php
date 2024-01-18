<x-app-layout>
    @section('title', 'Book Borrowed')
    <x-slot name="header">
        @include('borrowed.partials.borrowed-header')
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('layouts.partials.message-status')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900 dark:text-gray-100">
                        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                            <div class="flex flex-col md:flex-row -mx-4">
                                <div class="md:flex-1 px-4">
                                    <div class="h-[460px] rounded-lg bg-gray-300 mb-4">
                                        @if($borrowBook->book->cover != null or $borrowBook->book->cover != '')
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/' . $borrowBook->book->cover) }}"
                                                alt="Book Image">
                                        @else
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/no_image.jpg') }}" alt="Book Image">
                                        @endif
                                    </div>
                                    <div class="flex -mx-2 mb-4">
                                        @if ($borrowBook->status == 'borrowed')
                                        <div class="w-1/3 px-2">
                                            <form method= "post" action="{{ route('return.book', $borrowBook) }}">
                                                @csrf
                                                @method('patch')
                                                    <input type="hidden" name="status" value="returned">
                                                    <button
                                                        class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700">
                                                        {{ __('Return Book') }}</button>
                                            </form>
                                        </div>
                                        <div class="w-1/3 px-2">
                                            <button
                                                class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-borrowed-extend-{{ $borrowBook->id }}')">
                                                {{ __('Extend Due Date') }}
                                            </button>
                                        </div>
                                        @endif
                                        @if($borrowBook->status == 'returned')
                                        <div class="w-full px-2">
                                        @else
                                        <div class="w-1/3 px-2">
                                        @endif
                                            <x-delete-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-borrowed-deletion-{{ $borrowBook->id }}')">
                                            {{ __('Delete') }}
                                            </x-delete-button>
                                        </div>
                                    </div>
                                </div>
                                <div class="md:flex-1 px-4 text-black dark:text-gray-300">
                                    <h2 class="text-2xl font-bold dark:text-slate-300 mb-2">{{ $borrowBook->book->title }}
                                    </h2>
                                    <span class="font-bold text-gray-500">Author:</span>
                                    <span class=" mb-4">{{ $borrowBook->book->author->name }}</span>
                                    <div class="flex my-4">
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500">Copies:</span>
                                            <span
                                                class=" capitalize">{{ $borrowBook->book->copies }}</span>
                                        </div>
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500 ">On Hand:</span>
                                            <span class=" capitalize">
                                                {{ $borrowBook->book->copies - $borrowBook->book->borrowBooks->count() }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">Book Status:</span>
                                            <span class=" capitalize">
                                                @if ($borrowBook->book->copies - $borrowBook->book->borrowBooks->count() == 0)
                                                    Borrowed
                                                @else
                                                    {{ $borrowBook->book->status }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex mb-4">
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500">Publisher:</span>
                                            <span
                                                class=" capitalize">{{ $borrowBook->book->publisher->name }}</span>
                                        </div>
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500 ">Publication Year:</span>
                                            <span class=" capitalize">
                                                {{ $borrowBook->book->publication_year }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">ISBN:</span>
                                            <span class=" capitalize">{{ $borrowBook->book->isbn }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="my-5">
                                        <p class="text-2xl font-bold dark:text-slate-300">Borrower & Borrowed Book Status</p>
                                        <div class="flex my-4">
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Name:</span>
                                                <span class=" capitalize">
                                                    {{ $borrowBook->user->first_name }}
                                                    {{ $borrowBook->user->last_name }}
                                                </span>
                                            </div>
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Phone:</span>
                                                <span>{{ $borrowBook->user->phone }}</span>
                                            </div>
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Email:</span>
                                                <span>{{ $borrowBook->user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="flex my-3">
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Borrowed At: </span>
                                                <span>{{ $borrowBook->created_at->format('M d, Y h:m A') }}</span>
                                            </div>
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Due At:</span>
                                                <span>{{ $borrowBook->due_at->format('M d, Y h:m A') }}</span>
                                            </div>
                                        </div>
                                        <div class="flex my-4 mr-3 mt-3">
                                            <div class="mr-3 my-1">
                                                <span class="font-bold text-gray-500">Status:</span>
                                                @if($borrowBook->status == 'borrowed')
                                                <span class="capitalize text-red-500">
                                                @else
                                                <span class="capitalize text-green-500">
                                                @endif
                                                    {{ $borrowBook->status }}
                                                </span>
                                            </div>
                                            @if($borrowBook->status == 'returned')
                                            <div class='my-1'>
                                                <span class="font-bold text-gray-500">Returned At:</span>
                                                <span
                                                    class="text-gray-300">{{ $borrowBook->returned_at->format('M d, Y h:m a') }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="my-5">
                                        <p class="text-2xl font-bold dark:text-slate-300">Librarian Information</p>
                                        <div class="mr-3 mt-3">
                                            @if($borrowBook->status =='returned')
                                            <span class="font-bold text-gray-500">Returned To:</span>
                                            @else
                                            <span class="font-bold text-gray-500">Borrowed From:</span>
                                            @endif
                                            <span class="capitalize">
                                                {{ $borrowBook->librarian->first_name }}
                                                {{ $borrowBook->librarian->last_name }}
                                            </span>
                                        </div>
                                        <div class="mr-3 mt-3">
                                            <span class="font-bold text-gray-500">Remarks:</span>
                                            <span class="capitalize">
                                                {{ $borrowBook->remarks }}
                                            </span>
                                            <form method="post" action="{{ route('return.book', $borrowBook) }}">
                                                @csrf
                                                @method('patch')
                                                <div class="mt-3">
                                                    <x-input-label for="remarks" :value="__('Add Remarks')" />
                                                    <div class="flex">
                                                    <x-text-input id="remarks" name="remarks" type="text" class="mt-1 block w-full mr-2" :value="old('remarks')"  required autofocus autocomplete="remarks" />
                                                    <button class="bg-sky-600 text-white py-2 px-4 rounded-2xl font-bold hover:bg-sky-700">
                                                    {{ __('Save') }}</button>
                                                    </div>
                                                    <x-input-error class="mt-2" :messages="$errors->get('remarks')" />
                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            @include('borrowed.partials.extend-modal')
                            @include('borrowed.partials.borrowed-delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
