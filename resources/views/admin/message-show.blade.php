<x-app-layout>
    @section('title', 'Messages')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('layouts.partials.message-status')
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="w-full overflow-x-auto relative text-gray-300">
                    <div class="mb-4">
                        <label class="block text-gray-400 text-lg font-semibold mb-2">Name:</label>
                        <p class="text-gray-200 text-lg">{{ $message->name }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 text-lg font-semibold mb-2">Email:</label>
                        <p class="text-gray-200 text-lg">{{ $message->email }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-400 text-lg font-semibold mb-2">Message:</label>
                        <p class="text-gray-200  text-lg">{{ $message->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
