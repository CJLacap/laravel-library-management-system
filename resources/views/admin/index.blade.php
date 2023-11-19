<x-app-layout>
    @section('title', 'Admin Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="mt-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2  gap-6 lg:gap-8">
                            <div  class="scale-100 p-2  border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class=" overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Books</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class=" text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-6">
                                                        Books
                                                    </th>
                                                    <th class="pr-6">
                                                        Quantity
                                                    </th>
                                                    <th >
                                                        On Hand
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white">
                                                <tr>
                                                    <td>
                                                        {{ $books->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $books->sum('copies') }}
                                                    </td>
                                                    <td>
                                                        {{ $books->sum('copies') - $borrowBooks->where('status', 'borrowed')->count() }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <div  class="scale-100 p-2 border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Book Requests</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class=" text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-6">
                                                        Pending
                                                    </th>
                                                    <th class="pr-6">
                                                        Approved
                                                    </th>
                                                    <th class="">
                                                        Denied
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white">
                                                <tr>
                                                    <td>
                                                        {{ $bookRequests->where('status', 'pending')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $bookRequests->where('status', 'approved')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $bookRequests->where('status', 'denied')->count() }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>

                            <div  class="scale-100 p-2  border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Borrowed Books</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class=" text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-6">
                                                        Borrowed
                                                    </th>
                                                    <th class="pr-6">
                                                        Overdue
                                                    </th>
                                                    <th>
                                                        Due Soon
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white">
                                                <tr>
                                                    <td>
                                                        {{ $borrowBooks->where('status', 'borrowed')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $borrowBooks->where('status', 'borrowed')->where('due_at', '<=', now())->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $weekDueBooks->where('status', 'borrowed')->count() }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div  class="scale-100 p-2  border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Users</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class="text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-6">
                                                        Total
                                                    </th>
                                                    <th class="pr-6">
                                                        Active
                                                    </th>
                                                    <th class="pr-6">
                                                        Inactive
                                                    </th>
                                                    <th class="pr-6">
                                                        Blocked
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-white">
                                                <tr class="">
                                                    <td>
                                                        {{ $users->where('role', 'user')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $users->where('role', 'user')->where('status', 'active')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $users->where('role', 'user')->where('status', 'inactive')->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $users->where('role', 'user')->where('status', 'blocked')->count() }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="mt-16">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            <div  class="scale-100 p-2  border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">This Week Pending Book Requests (<span class="text-blue-400">{{  $weekBookRequests->where('status', '=','pending')->count() }}</span>)</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if( $weekBookRequests->where('status', 'pending')->count() != 0)
                                            <thead class="text-gray-300 uppercase bg-gray-700">
                                                <tr>
                                                    <th scope="col" class="py-4 px-4">
                                                        Full Name
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Book 
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Date 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (  $weekBookRequests->where('status', '=','pending')->take(10) as $weekBookRequest)
                                                <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600"
                                                onclick="window.location='{{ route('request.view', $weekBookRequest) }}'" style="cursor: pointer;">
                                                    
                                                    <td class="py-2 px-6">
                                                        {{ $weekBookRequest->user->first_name }}
                                                        {{ $weekBookRequest->user->last_name }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{  substr($weekBookRequest->book->title,0, 20). '...' }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{ $weekBookRequest->created_at->diffForHumans() }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <h3 class="text-center">No Pending Requests</h3>
                                            @endif
                                        </table>
                                    </div>
                                    @if( $weekBookRequests->where('status', 'pending')->count() != 0)
                                    <button class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                    onclick="window.location='{{ route('pending') }}'">view all</button>
                                    @endif
                                </div>
                            </div>

                            <div  class="scale-100 p-2 border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3 ">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">This Week Approved Book Requests (<span class="text-blue-400">{{ $weekBookRequests->where('status', 'approved')->count() }}</span>)</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if( $weekBookRequests->where('status', 'approved')->count() != 0)
                                            <thead class="text-gray-300 uppercase bg-gray-700">
                                                <tr>
                                                    <th scope="col" class="py-4 px-4">
                                                        Full Name
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Book 
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Approved At 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $weekBookRequests->where('status', 'approved')->take(10) as $weekBookRequest)
                                                <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600"
                                                onclick="window.location='{{ route('request.view', $weekBookRequest) }}'" style="cursor: pointer;">
                                                    
                                                    <td class="py-2 px-6">
                                                        {{ $weekBookRequest->user->first_name }}
                                                        {{ $weekBookRequest->user->last_name }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{  substr($weekBookRequest->book->title,0, 20). '...' }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{ $weekBookRequest->updated_at->diffForHumans() }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <h3 class="text-center">No Approved Requests</h3>
                                            @endif
                                        </table>

                                    </div>
                                    @if( $weekBookRequests->where('status', 'approved')->count() != 0)
                                    <button class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                    onclick="window.location='{{ route('approved') }}'">view all</button>
                                    @endif
                                </div>
                            </div>

                            <div  class="scale-100 p-2 border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3 ">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">This Week Borrowed Books Due (<span class="text-blue-400">{{ $weekDueBooks->where('status', 'borrowed')->count() }}</span>)</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if( $weekDueBooks->where('status', 'borrowed')->count() != 0)
                                            <thead class="text-gray-300 uppercase bg-gray-700">
                                                <tr>
                                                    <th scope="col" class="py-4 px-4">
                                                        Full Name
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Book 
                                                    </th>
                                                    <th scope="col" class="py-4 px-4">
                                                        Due At 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach( $weekDueBooks->where('status', 'borrowed')->take(10) as $weekDueBook)
                                                <tr class="bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600"
                                                onclick="window.location='{{ route('borrowed.show', $weekDueBook) }}'" style="cursor: pointer;">
                                                    
                                                    <td class="py-2 px-6">
                                                        {{ $weekDueBook->user->first_name }}
                                                        {{ $weekDueBook->user->last_name }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{  substr($weekDueBook->book->title,0, 20). '...' }}
                                                    </td>
                                                    <td class="py-2 px-6">
                                                        {{ $weekDueBook->due_at->format('M d, Y') }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <h3 class="text-center">No Approved Requests</h3>
                                            @endif
                                        </table>

                                    </div>
                                    @if( $weekDueBooks->where('status', 'borrowed')->count() != 0)
                                    <button class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                    onclick="window.location='{{ route('borrowed') }}'">view all</button>
                                    @endif
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</x-app-layout>
