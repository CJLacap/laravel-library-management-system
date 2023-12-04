<x-home-layout>
    @section('title', 'Contact Us | ')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="mt-16">
                
                <div class="container mx-auto mt-8 p-8 bg-transparent shadow-md">
                    @include('layouts.partials.message-status')
                    <h1 class="text-5xl text-center text-sky-500 font-bold mb-10">Contact Us</h1>
                    <form action="{{ route('home.contactUs.submit') }}" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-200 text-sm font-bold mb-2">Name:</label>
                            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-200 text-sm font-bold mb-2">Email:</label>
                            <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-200 text-sm font-bold mb-2">Message:</label>
                            <textarea id="message" name="message" rows="4" class="w-full p-2 border border-gray-300 rounded"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-blue-500 text-white p-4 rounded-md">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>