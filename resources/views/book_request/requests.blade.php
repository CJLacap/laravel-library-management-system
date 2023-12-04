<x-app-layout>
    @section('title', 'Book Requests')
    <x-slot name="header">
        @include('book_request.partials.request-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-white">Search Requests</h3>
            <form method="get" action="" class="py-6">
                @csrf
                @method('get')
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
                        placeholder="Search Book Request Information" required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
            @include('layouts.partials.message-status')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">    
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="max-w-10xl overflow-x-auto relative">
                            <table class="mx-auto text-gray-500">
                                <thead class="text-gray-300 uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-6 px-6">
                                            ID
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            First Name
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Last Name
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Book Title
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Author
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Book Status
                                         </th>
                                        <th scope="col" class="py-6 px-6">
                                            Created AT
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Updated AT
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Status
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Remarks
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookRequests as $bookRequest)
                                        <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600 text-white capitalize">
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->id }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->user->first_name }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->user->last_name }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                <a href="{{ route('book.show', $bookRequest->book) }}">{{ $bookRequest->book->title }}</a>
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->book->author->name }}
                                            </td>
                                            <td class="py-4 px-6 text-center ">
                                            @if($bookRequest->book->copies - $bookRequest->book->borrowBooks->count() == 0)
                                                Borrowed
                                            @else
                                                {{ $bookRequest->book->status }}
                                            @endif
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->created_at->diffForHumans() }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $bookRequest->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="py-4 px-6 text-center ">
                                                {{ $bookRequest->status }}
                                            </td>
                                            <td class="py-4 px-6 text-center ">
                                                {{ $bookRequest->remarks }}
                                            </td>
                                            <td class="relative py-4 px-6">
                                                @include('book_request.partials.request-action')
                                                @include('book_request.partials.request-delete')
                                                @include('book_request.partials.status-update-modal')
                                                @include('book_request.partials.borrow-modal')
                                             
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($bookRequests->count() == 0)
                            <div class="text-center text-lg mt-4">
                                <p>No Result Found</p>
                            </div>
                            @endif
                            <div class="mx-auto max-w-lg pt-6 p-4">
                                {{ $bookRequests->Links() }}     
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</x-app-layout>
