<x-app-layout>
    @section('title', 'User Book Requests')
    <x-slot name="header">
        @include('book_request.partials.request-header')
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
                                        @if ($bookRequest->book->cover != null or $bookRequest->book->cover != '')
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/' . $bookRequest->book->cover) }}"
                                                alt="Book Image">
                                        @else
                                            <img class="w-full h-full object-fill"
                                                src="{{ asset('storage/book_cover/no_image.jpg') }}" alt="Book Image">
                                        @endif
                                    </div>
                                    <div class="flex -mx-2 mb-4">
                                        @if($bookRequest->status == 'pending')
                                        <div class="w-1/3 px-2">
                                            <form method= "post" action="{{ route('request.status.update', $bookRequest) }}">
                                                @csrf
                                                @method('patch')
                                                
                                                    <input type="hidden" name="status" value="approved">
                                                    <button
                                                        class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700">
                                                        {{ __('Approve') }}</button>
                                            </form>
                                        </div>
                                        @endif

                                        @if($bookRequest->status == 'approved')
                                        <div class="w-1/3 px-2">
                                        <button
                                        class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700"
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'request-borrow-{{ $bookRequest->id }}')">
                                        {{ __('Borrow') }}</button>
                                        </div>
                                        <div class="w-1/3 px-2">
                                            <button
                                                class="w-full bg-red-600 text-white py-2 px-4 rounded-full font-bold hover:bg-red-700"
                                                x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'status-update-override-{{ $bookRequest->id }}')">
                                                {{ __('Deny') }}
                                            </button>
                                        </div>
                                        @endif


                                        @if($bookRequest->status == 'denied' || $bookRequest->status == 'cancelled') 
                                        <div class="w-1/2 px-2">
                                        <button
                                        class="w-full bg-sky-600 text-white py-2 px-4 rounded-full font-bold hover:bg-sky-700" 
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'status-update-override-{{ $bookRequest->id }}')">
                                        {{ __('Approve') }}</button>
                                        </div>
                                        <div class="w-1/2 px-2">
                                            <x-delete-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-request-deletion-{{ $bookRequest->id }}')">{{ __('Delete') }}
                                            </x-delete-button>
                                        </div>
                                        @endif

                                        @if($bookRequest->status == 'pending')
                                            <div class="w-1/3 px-2">
                                                <form method= "post" action="{{ route('request.status.update', $bookRequest) }}">
                                                    @csrf
                                                    @method('patch')
                                                    <input type="hidden" name="status" value="denied">
                                                    <button
                                                        class="w-full bg-red-600 text-white py-2 px-4 rounded-full font-bold hover:bg-red-700">
                                                        {{ __('Deny') }}</button>
                                                </form>
                                            </div>
                                        @endif
                                        @if($bookRequest->status != 'denied')
                                        <div class="w-1/3 px-2">
                                            <x-delete-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-request-deletion-{{ $bookRequest->id }}')">{{ __('Delete') }}
                                            </x-delete-button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="md:flex-1 px-4">
                                    <h2 class="text-2xl font-bold text-slate-300 mb-2">{{ $bookRequest->book->title }}
                                    </h2>
                                    <span class="font-bold text-gray-500">Author:</span>
                                    <span class="text-gray-300 mb-4">{{ $bookRequest->book->author->name }}</span>
                                    <div class="flex my-2">
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500">Copies:</span>
                                            <span
                                                class="text-gray-300 capitalize">{{ $bookRequest->book->copies }}</span>
                                        </div>
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500 ">On Hand:</span>
                                            <span class="text-gray-300 capitalize">
                                                {{ $bookRequest->book->copies - $bookRequest->book->borrowBooks->count() }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">Book Availability:</span>
                                            <span class="text-gray-300 capitalize">
                                                @if ($bookRequest->book->copies - $bookRequest->book->borrowBooks->count() == 0)
                                                    Borrowed
                                                @else
                                                    {{ $bookRequest->book->status }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex mb-1">
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500">Publisher:</span>
                                            <span
                                                class="text-gray-300 capitalize">{{ $bookRequest->book->publisher->name }}</span>
                                        </div>
                                        <div class="mr-4">
                                            <span class="font-bold text-gray-500 ">Publisher Date:</span>
                                            <span class="text-gray-300 capitalize">
                                                {{ $bookRequest->book->publication_year }}</span>
                                        </div>
                                        <div>
                                            <span class="font-bold text-gray-500 ">ISBN:</span>
                                            <span class="text-gray-300 capitalize">{{ $bookRequest->book->isbn }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="my-5">
                                        <p class="text-2xl font-bold text-slate-300">Request Information</p>
                                        <div class="flex my-3">
                                            <div class="mr-3">
                                                <span class="font-bold text-gray-500">Name:</span>
                                                <span class="text-gray-300 capitalize">
                                                    {{ $bookRequest->user->first_name }}
                                                    {{ $bookRequest->user->last_name }}
                                                </span>
                                            </div>
                                            <div class="mr-3">
                                                <span class="font-bold text-gray-500">Phone:</span>
                                                <span class="text-gray-300">{{ $bookRequest->user->phone }}</span>
                                            </div>
                                            <div class="mr-3">
                                                <span class="font-bold text-gray-500">Email:</span>
                                                <span class="text-gray-300 ">{{ $bookRequest->user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="flex my-3">
                                            <div class="mr-3">
                                                <span class="font-bold text-gray-500">Created At: </span>
                                                <span
                                                    class="text-gray-300 capitalize">{{ $bookRequest->created_at->format('M-d-Y h:m a') }}</span>
                                            </div>
                                            <div>
                                                <span class="font-bold text-gray-500">Updated At:</span>
                                                <span
                                                    class="text-gray-300">{{ $bookRequest->updated_at->format('M-d-Y h:m a') }}</span>
                                            </div>
                                        </div>
                                        <div class="mr-3 mt-3">
                                            <span class="font-bold text-gray-500">Request Status:</span>
                                            @if($bookRequest->status == 'approved')
                                            <span class="capitalize text-blue-500">
                                            @elseif($bookRequest->status == 'cancelled' || $bookRequest->status == 'denied')
                                            <span class="capitalize text-red-500">
                                            @else
                                            <span class="capitalize text-green-500">
                                            @endif
                                                {{ $bookRequest->status }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="my-5">
                                        <p class="text-2xl font-bold text-slate-300">Librarian Information</p>
                                        <div class="mr-3 mt-3">
                                            <span class="font-bold text-gray-500">Approved/Denied By:</span>
                                            <span class="text-gray-300 capitalize">
                                                @if($bookRequest->librarian_id != null)
                                                {{ $bookRequest->librarian->first_name }}
                                                {{ $bookRequest->librarian->last_name }}
                                                
                                                @endif
                                            </span>
                                        </div>
                                        <div class="mr-3 mt-3">
                                            <span class="font-bold text-gray-500">Remarks:</span>
                                            <span class="text-gray-300 capitalize">
                                                {{ $bookRequest->remarks }}
                                            </span>
                                            <form method="post" action="{{ route('request.status.update', $bookRequest) }}">
                                                @csrf
                                                @method('patch')
                                                <div class="mt-3">
                                                    <x-input-label for="remarks" :value="__('Add Remarks')" />
                                                    <div class="flex">
                                                    <x-text-input id="remarks" name="remarks" type="text" class="mt-1 block w-full mr-2" :value="old('remarks')"  autofocus autocomplete="remarks" />
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
                            @include('book_request.partials.status-update-modal')
                            @include('book_request.partials.borrow-modal')
                            @include('book_request.partials.request-delete')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
