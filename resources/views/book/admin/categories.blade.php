<x-app-layout>
    @section('title','Categories')
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <h3 class="text-white">Search Category</h3>
            <form method="get" action="" class="py-6">
                @csrf
                @method('get')
                <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input type="search" id="search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Category" required>
                    <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
                
                @if(session()->has('message'))
                    <div class="mt-4 text-red-600">
                     {{ session()->get('message') }}
                    </div>
                @endif
            </form>
            @include('layouts.partials.message-status')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flow-root">
                        <a href="{{ route('category.create') }}" class="float-right  bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded">Add new category</a>
                    </div>
                        <div class="max-w-10xl overflow-x-auto relative">
                            <table class="mx-auto  text-gray-500">
                                <thead class=" text-gray-300 uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-6 px-6">
                                            Category ID
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Name
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Created Date
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Updated Date
                                        </th>
                                        <th scope="col">
                    
                                        </th>
                                        <th scope="col">
                    
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    
                                        <tr class="bg-gray-800 border-b text-sm text-white">
                                            <td class="py-4 px-6 text-center">
                                                {{ $category->id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $category->name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $category->created_at->diffForHumans() }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $category->updated_at->diffForHumans() }}
                                            </td>
                                            <td class="py-2 px-3">
                                                <a href="categories/{{ $category->id }}" class="bg-sky-600 text-white px-4 py-2 rounded">Edit</a>
                                            </td>
                                                                                   
                                            <form class="" method="POST" action="{{ route('category.destroy', $category) }}">
                                            @csrf
                                            @method('delete')
                                            <td class="py-2 px-3">
                                                <x-danger-button>
                                                    {{ __('Delete') }}
                                                </x-danger-button>
                                            </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mx-auto max-w-lg pt-6 p-4">
                                {{ $categories->Links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
