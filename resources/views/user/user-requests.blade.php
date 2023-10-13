<x-app-layout>
    @section('title', 'Book Request')
    <x-slot name="header">
        @include('user.partials.request-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('user.partials.request-message')
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-10xl overflow-x-auto relative">
                        <table class="mx-auto  text-gray-500">
                            <thead class=" text-gray-300 uppercase bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-6 px-6">
                                        Book Title
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Author
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Created At
                                    </th>
                                    <th scope="col">
                                        Updated At
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Status
                                    </th>
                                    <th scope="col" class="py-6 px-6">
                                        Remarks
                                    </th>
                                    <th scope="col">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($bookRequests as $bookRequest)
                                <tr class="bg-gray-800 border-b text-sm text-white">
                                    <td class="py-4 px-6 text-center">
                                        {{ $bookRequest->book->title }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $bookRequest->book->author->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $bookRequest->created_at->format('M-d-Y') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $bookRequest->updated_at->format('M-d-Y') }}
                                    </td>
                                    <td class="py-4 px-6 capitalize">
                                        {{ $bookRequest->status }}
                                    </td>
                                    <td class="py-4 px-6 capitalize">
                                        {{ $bookRequest->remarks }}
                                    </td>
                                    @if($bookRequest->status == 'pending')
                                    <form method="POST" action="{{ route('request.update', $bookRequest) }}">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="status" value='cancelled'>
                                        <td class="py-2 px-3">
                                            <x-danger-button>
                                                {{ __('Cancel') }}
                                            </x-danger-button>
                                        </td>
                                    </form>
                                    @elseif($bookRequest->status == 'cancelled' || $bookRequest->status == 'denied')
                                    <form method="POST" action="{{ route('request.destroy', $bookRequest) }}">
                                        @csrf
                                        @method('delete')
                                        <td class="py-2 px-3">
                                            <x-danger-button>
                                                {{ __('Delete') }}
                                            </x-danger-button>
                                        </td>
                                    </form>
                                    @endif
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
    
</x-app-layout>
