<x-app-layout>
    @section('title', 'Librarian Accounts')
    <x-slot name="header">
        @include('admin.partials.librarian.librarian-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-white">Search Librarian Accounts</h3>
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
                    <input type="search" id="librarian" name="librarian"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search User Information">
                    <button type="submit"
                        class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
            @include('layouts.partials.message-status')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-10xl overflow-x-auto relative">
                        <table class="mx-auto  text-gray-500">
                            <thead class=" text-gray-300 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-6 px-6">
                                        First Name
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Last Name
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Email
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Address
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Phone
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Role
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Status
                                    </th>
                                    <th scope="col">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($librarians as $librarian)
                                    <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600 text-white">
                                        <td class="py-4 px-6">
                                            {{ $librarian->first_name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->last_name }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->email }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->address }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->phone }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->role }}
                                        </td>
                                        <td class="py-4 px-6">
                                            {{ $librarian->status }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <a href="librarian/{{ $librarian->id }}"
                                                class="bg-sky-600 text-white px-4 py-2 rounded">view</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mx-auto max-w-lg pt-6 p-4">
                            {{ $librarians->Links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
