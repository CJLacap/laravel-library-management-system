<x-app-layout>
    @section('title', 'Borrowed Books')
    <x-slot name="header">
       @include('borrowed.partials.borrowed-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-white">Search Borrowed Books</h3>
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
                        placeholder="Search Borrowed Books Information" required>
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
            @include('layouts.partials.message-status')  
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="max-w-10xl overflow-x-auto  relative">
                            <table class="mx-auto  text-gray-500">
                                <thead class=" text-gray-300 uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-6 px-6">
                                            ID
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Book Title
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Author
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Borrower
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Librarian
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Borrowed Date
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Due Date
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Returned Date
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Status
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($borrowBooks as $borrowBook)
                                        <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600 text-white capitalize">
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->id }} 
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->book->title }}  
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->book->author->name }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->user->first_name }} 
                                                {{ $borrowBook->user->last_name }} 
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->librarian->first_name }} 
                                                {{ $borrowBook->librarian->last_name }} 
                                            </td>
                                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                                {{ $borrowBook->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                                {{ $borrowBook->due_at->format('M d, Y') }} 
                                            </td>
                                            <td class="py-4 px-6 text-center whitespace-nowrap">
                                                @if($borrowBook->returned_at != null)
                                                {{ $borrowBook->returned_at->format('M d, Y') }}
                                                @endif 
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $borrowBook->status }} 
                                            </td>
                                            <td class="relative py-4 px-6">
                                                <x-dropdown align="right" width="48">
                                                    <x-slot name="trigger">
                                                        <button class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button"> 
                                                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                                                            </svg>
                                                        </button>
                                                    </x-slot>
                                                    <x-slot  name="content">
                                                        <x-dropdown-link :href="route('borrowed.show', $borrowBook)">
                                                            {{ __('View') }}
                                                        </x-dropdown-link>
                                                        <form method="post" action="{{ route('return.book', $borrowBook) }}">
                                                            @csrf
                                                            @method('patch')
                                                        <x-dropdown-link :href="route('return.book', $borrowBook)"
                                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                            <input type="hidden" name="status" value="returned">
                                                            {{ __('Return') }}
                                                        </x-dropdown-link>
                                                        </form>
                                                        @if($borrowBook->status == 'borrowed')
                                                        <x-dropdown-link :href="route('request.destroy', $borrowBook)"
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-borrowed-extend-{{ $borrowBook->id }}')">
                                                            {{ __('Extend') }}
                                                        </x-dropdown-link>
                                                        @endif
                                                        <x-dropdown-link :href="route('request.destroy', $borrowBook)"
                                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-borrowed-deletion-{{ $borrowBook->id }}')">
                                                            {{ __('Delete') }}
                                                        </x-dropdown-link>
                                                        </x-slot>
                                                </x-dropdown>
                                                @include('borrowed.partials.extend-modal')
                                                @include('borrowed.partials.borrowed-delete')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($borrowBooks->count() == 0)
                                <div class="text-center text-lg mt-4">
                                    <p>No Result Found</p>
                                </div>
                            @endif
                            <div class="mx-auto max-w-lg pt-6 p-4">
                                {{ $borrowBooks->Links() }}     
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</x-app-layout>
