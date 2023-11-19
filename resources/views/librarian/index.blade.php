<x-app-layout>
    @section('title', 'Librarian Dashboard')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Librarian Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div
                        class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">
                        <div
                            class="w-72 shadow-md rounded-lg duration-500 hover:scale-105 hover:shadow-xl border-4 border-gray-400">
                            <p class="text-xl mx-2 my-2 mb-4">Book Requests</p>
                            <div class="text-center capitalize pb-5">
                                <table class="ml-1">
                                    <thead>
                                        <tr>
                                            <th class="px-6">
                                                Pending
                                            </th>
                                            <th>
                                                Approved
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $bookRequests->where('status', 'pending')->count() }}
                                            </td>
                                            <td>
                                                {{ $bookRequests->where('status', 'approved')->count() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            class="w-72 shadow-md rounded-lg duration-500 hover:scale-105 hover:shadow-xl border-4 border-gray-400">
                            <p class="text-xl mx-2 my-2 mb-4">Borrowed Books</p>
                            <div class="text-center capitalize">
                                <table class="ml-1">
                                    <thead>
                                        <tr>
                                            <th class="px-6">
                                                Total Books
                                            </th>
                                            <th>
                                                Past Due 
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $borrowBooks->where('status', 'borrowed')->count() }}
                                            </td>
                                            <td>
                                                {{ $borrowBooks->where('status', 'borrowed')->where('due_at', '<=', now())->count() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div
                            class="w-72 shadow-md rounded-lg duration-500 hover:scale-105 hover:shadow-xl border-4 border-gray-400">
                            <p class="text-xl mx-2 my-2 mb-4">Users</p>
                            <div class="text-center capitalize">
                                <table class="ml-1">
                                    <thead>
                                        <tr>
                                            <th class="px-6">
                                                Total Users
                                            </th>
                                            <th>
                                                Active Users
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $users->where('role', 'user')->count() }}
                                            </td>
                                            <td>
                                                {{ $users->where('role', 'user')->where('status', 'active')->count() }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        


                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
