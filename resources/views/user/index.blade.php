<x-app-layout>
    @section('title', 'Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-6">
                        {{-- Grid Count --}}
                        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2  gap-6 lg:gap-8">
                            {{-- Book Request Count --}}
                            <div
                                class="scale-100 p-2 border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Book
                                        Requests</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class=" text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-4">
                                                        Pending
                                                    </th>
                                                    <th class="px-4">
                                                        Approved
                                                    </th>
                                                    <th class="px-4">
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
                            {{-- Borrowed Books Count --}}
                            <div
                                class="scale-100 p-2  border-4 border-gray-400 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Borrowed
                                        Books</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize">
                                        <table class=" text-center mx-2">
                                            <thead class="text-sm text-gray-300 uppercase">
                                                <tr>
                                                    <th class="px-4">
                                                        Borrowed
                                                    </th>
                                                    <th class="px-4">
                                                        Overdue
                                                    </th>
                                                    <th class="px-4">
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
                                                        {{ $borrowBooks->where('status', 'borrowed')->where('due_at', '<', now())->count() }}
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
                        </div>
                    </div>

                    {{-- Start of Tables --}}
                    <div class="mt-16">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                            {{-- Table for pending book requests --}}
                            <div
                                class="scale-100 p-2  border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Pending Book
                                        Requests (<span
                                            class="text-blue-400">{{ $bookRequests->where('status', '=', 'pending')->count() }}</span>)</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if ($bookRequests->where('status', 'pending')->count() != 0)
                                                <thead class="text-gray-300 uppercase bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-4 px-4">
                                                            Book Title
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Author
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Date
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookRequests->where('status', '=', 'pending')->take(10) as $bookRequest)
                                                        <tr
                                                            class="text-sm bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600">

                                                            <td class="py-2 px-6">
                                                                <a
                                                                    href="{{ route('user.showBook', $bookRequest->book->id) }}">
                                                                    {{ substr($bookRequest->book->title, 0, 20) . '...' }}
                                                                </a>
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $bookRequest->book->author->name }}
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $bookRequest->created_at->format('m/d/Y') }}
                                                            </td>
                                                            @if ($bookRequest->status == 'pending')
                                                                <form method="POST"
                                                                    action="{{ route('user.request.update', $bookRequest) }}">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" name="status" value='cancel'>
                                                                    <td class="py-2 px-3">
                                                                        <x-danger-button>
                                                                            {{ __('Cancel') }}
                                                                        </x-danger-button>
                                                                    </td>
                                                                </form>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <h3 class="text-center">No Pending Requests</h3>
                                            @endif
                                        </table>
                                    </div>
                                    @if ($bookRequests->where('status', 'pending')->count() != 0)
                                        <button
                                            class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                            onclick="window.location='{{ route('user.request.pending') }}'">view all
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Table for approved book requests --}}
                            <div
                                class="scale-100 p-2  border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Approved Book
                                        Requests (<span
                                            class="text-blue-400">{{ $bookRequests->where('status', '=', 'approved')->count() }}</span>)</span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if ($bookRequests->where('status', 'approved')->count() != 0)
                                                <thead class="text-gray-300 uppercase bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-4 px-4">
                                                            Book Title
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Author
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Date
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Remarks
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($bookRequests->where('status', '=', 'approved')->take(10) as $bookRequest)
                                                        <tr
                                                            class="text-sm bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600">

                                                            <td class="py-2 px-6">
                                                                <a
                                                                    href="{{ route('user.showBook', $bookRequest->book->id) }}">
                                                                    {{ substr($bookRequest->book->title, 0, 20) . '...' }}
                                                                </a>
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $bookRequest->book->author->name }}
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $bookRequest->created_at->format('m/d/Y') }}
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $bookRequest->remarks }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <h3 class="text-center">No Approved Requests</h3>
                                            @endif
                                        </table>
                                    </div>
                                    @if ($bookRequests->where('status', 'approved')->count() != 0)
                                        <button
                                            class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                            onclick="window.location='{{ route('user.request.approved') }}'">view all
                                        </button>
                                    @endif
                                </div>
                            </div>

                            {{-- Table for approved book requests --}}
                            <div
                                class="scale-100 p-2  border-2 border-gray-500 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                <div class="overflow-hidden pt-3">
                                    <span class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">
                                        Borrowed Books 
                                        (<span class="text-blue-400">{{ $borrowBooks->where('status', '=', 'borrowed')->count() }}</span>)
                                    </span>
                                    <div class="max-w-10xl overflow-x-auto relative mt-2 capitalize mx-5">
                                        <table class="mt-4 mx-auto text-gray-100  ">
                                            @if ($borrowBooks->where('status', 'borrowed')->count() != 0)
                                                <thead class="text-gray-300 uppercase bg-gray-700">
                                                    <tr>
                                                        <th scope="col" class="py-4 px-4">
                                                            Book Title
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Borrowed At
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Due At
                                                        </th>
                                                        <th scope="col" class="py-4 px-4">
                                                            Remarks
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($borrowBooks->where('status', '=', 'borrowed')->take(10) as $borrowBook)
                                                        <tr
                                                            class="text-sm bg-gray-800 border-b hover:bg-gray-50 dark:hover:bg-gray-600">

                                                            <td class="py-2 px-6">
                                                                <a href="{{ route('user.showBook', $borrowBook->book->id) }}">
                                                                    {{ substr($borrowBook->book->title, 0, 20) . '...' }}
                                                                </a>
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $borrowBook->created_at->format('m/d/Y') }}
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $borrowBook->due_at->format('m/d/Y') }}
                                                            </td>
                                                            <td class="py-2 px-6">
                                                                {{ $borrowBook->remarks }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            @else
                                                <h3 class="text-center">No Approved Requests</h3>
                                            @endif
                                        </table>
                                    </div>
                                    @if ($borrowBooks->where('status', 'borrowed')->count() != 0)
                                        <button
                                            class="float-right text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-6 capitalize"
                                            onclick="window.location='{{ route('user.borrowed.borrowed') }}'">view all
                                        </button>
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
