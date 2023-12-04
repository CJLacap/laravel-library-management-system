<x-app-layout>
    @section('title', 'Messages')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           <a href="{{ route('admin.messages') }}"> 
                {{ __('Messages |') }} 
            </a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-fit mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('layouts.partials.message-status')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full overflow-x-auto relative">
                    <table class="mx-auto text-gray-500">
                        <thead class=" text-gray-300 uppercase bg-gray-700">
                            <tr>
                                <th scope="col" class="py-6 px-6">
                                    ID
                                </th>
                                <th scope="col" class="py-6 px-6">
                                    Name
                                </th>
                                <th scope="col" class="py-6 px-6">
                                    Email
                                </th>
                                <th scope="col" class="py-6 px-6">
                                    Messages
                                </th>
                                <th scope="col" class="py-6 px-6">
                                    Date Sent
                                </th>
                                <th scope="col" class="py-6 px-6">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                            
                                <tr class="bg-gray-800 border-b  text-white">
                                    <td class="py-4 px-6 text-center ">
                                        {{ $message->id }}
                                    </td>
                                    <td class="py-4 px-6 capitalize whitespace-nowrap">
                                        {{ $message->name }}
                                    </td>
                                    <td class="py-4 px-6">
                                        {{ $message->email }}
                                    </td>
                                    <td class="py-4 px-6 whitespace-nowrap">
                                        {{ substr($message->message,0, 75). '. . .'  }}
                                    </td>
                                    <td class="py-4 px-6 text-center">
                                        {{ $message->created_at->format('m/d/Y') }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <x-dropdown align="right" width="48">
                                            <x-slot name="trigger">
                                                <button
                                                    class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-5 h-5" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 4 15">
                                                        <path
                                                            d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                    </svg>
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <x-dropdown-link :href="route('admin.message.show', $message)">
                                                    {{ __('View') }}
                                                </x-dropdown-link>
                                                <x-dropdown-link :href="route('admin.message.destroy', $message)"
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-message-deletion-{{ $message->id }}')">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </x-slot>
                                        </x-dropdown>
                                        @include('admin.partials.admin.message-delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($messages->count() == 0)
                    <div class="text-center text-white text-lg mt-4">
                        <p>No Message Found</p>
                    </div>
                    @endif
                    <div class="mx-auto max-w-lg pt-6 p-4">
                        {{ $messages->Links() }}     
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
