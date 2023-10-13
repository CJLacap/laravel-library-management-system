<x-app-layout>
    @section('title','Books')
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            @if(session('status') === 'book-deleted')
            <div  x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)" class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">A Book Successfuly Deleted!</span>
                </div>
            </div>
            @endif
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3>Search Books</h3>
                    <form method="get" action="" class="py-6">
                        @csrf
                        @method('get') 
                        <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="search" id="search" name="search" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Book Information" required>
                            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                        </div>
                        
                        @if(session()->has('message'))
                            <div class="mt-4 text-red-600">
                             {{ session()->get('message') }}
                            </div>
                        @endif
                    </form>
                    
                        <div class="max-w-10xl overflow-x-auto relative">
                            <table class="mx-auto  text-gray-500">
                                <thead class=" text-gray-300 uppercase bg-gray-700">
                                    <tr>
                                        <th scope="col" class="py-6 px-6">
                                            Book ID
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Title
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Author
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            ISBN
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Publisher
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Publication Year 
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Category 
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Copies 
                                        </th>
                                        <th scope="col" class="py-6 px-6">
                                            Status 
                                        </th>
                                        <th scope="col">
                    
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($books as $book)
                                    
                                        <tr class="bg-gray-800 border-b text-sm text-white">
                                            <td class="py-4 px-6 text-center">
                                                {{ $book->id }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $book->title }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $book->author->name }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $book->isbn }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $book->publisher->name }}
                                            </td>
                                            <td class="py-4 px-6 text-center">
                                                {{ $book->publication_year }}
                                            </td>
                                            <td class="py-4 px-6">
                                                @foreach ($book->bookCategories as $category)
                                                {{ $category->category->name }}, 
                                                @endforeach
                                            </td>
                                            
                                            <td class="py-4 px-6 text-center">
                                                {{ $book->copies }}
                                            </td>
                                            <td class="py-4 px-6">
                                                {{ $book->status }}
                                            </td>
                                            <td class="py-2 px-3">
                                                <a href="book/{{ $book->id }}" class="bg-sky-600 text-white px-4 py-2 rounded">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mx-auto max-w-lg pt-6 p-4">
                                {{ $books->Links() }}
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
