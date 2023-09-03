<x-app-layout>
    @section('title','Add Book')
    <x-slot name="header">
        @include('book.partials.book-header')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Book Details') }}
                            </h2>
                    
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Add new book information.") }}
                            </p>
                        </header>
    
                    
                        <form method="post" action="" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                            
                            <!-- Book Cover -->
                            <div class="cover">
                                <x-input-label for="cover" :value="__('Add Book Cover')" />
                                <x-text-input id="cover" name="cover" type="file" class="mt-1 block w-full" :value="old('cover')" autofocus autocomplete="cover" />
                                <x-input-error class="mt-2" :messages="$errors->get('cover')" />
                              </div>                      
    
                            <!-- Book Title -->
                            <div>
                                <x-input-label for="title" :value="__('Book Title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>
    
                            <!-- Book Author -->
                            <div>
                                <x-input-label for="author" :value="__('Book Author')" />
                                <x-text-input id="author" name="author" type="text" list="authors" class="mt-1 block w-full" :value="old('author')" required autofocus autocomplete="author" />
                                <datalist id="authors">
                                    <option value="Author1"> 
                                    <option value="dsadad"> 
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('author')" />
                            </div>
                            
                            <!-- Book ISBN -->
                              <div>
                                <x-input-label for="isbn" :value="__('Book ISBN')" />
                                <x-text-input id="isbn" name="isbn" type="text" class="mt-1 block w-full" :value="old('isbn')" required autofocus autocomplete="isbn" />
                                <x-input-error class="mt-2" :messages="$errors->get('isbn')" />
                            </div>
    
                            <!-- Book Publisher -->
                            <div>
                                <x-input-label for="publisher" :value="__('Book Publisher')" />
                                <x-text-input id="publisher" name="publisher" type="text" class="mt-1 block w-full" :value="old('publisher')" required autofocus autocomplete="publisher" />
                                <x-input-error class="mt-2" :messages="$errors->get('publisher')" />
                            </div>
    
                            <!-- Book Publication Year -->
                            <div>
                                <x-input-label for="publication_year" :value="__('Book Publication Year')" />
                                <x-text-input id="publication_year" name="publication_year" type="text" class="mt-1 block w-full" :value="old('publication_year')" required autofocus autocomplete="publication_year" />
                                <x-input-error class="mt-2" :messages="$errors->get('publication_year')" />
                            </div>
    
                              <!-- Book Category -->
                              <div>
                                <x-input-label for="category" :value="__('Book Category')" />
                                <x-text-input id="isbn" name="category" type="text" list="categories" class="mt-1 block w-full" :value="old('category')" required autofocus autocomplete="category" />
                                <datalist id="categories">
                                    <option value="1">
                                    <option value="2">
                                </datalist>
                                <x-input-error class="mt-2" :messages="$errors->get('category')" />
                            </div>
    
                            <!-- Book Copies -->
                            <div>
                                <x-input-label for="copies" :value="__('Book Copies')" />
                                <x-text-input id="copies" name="copies" type="text" class="mt-1 block w-full" :value="old('copies')" required autofocus autocomplete="copies" />
                                <x-input-error class="mt-2" :messages="$errors->get('copies')" />
                            </div>
                            
                            <header>
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Book Location') }}
                                </h2>
                        
                            </header>
    
                              <!-- Book floor -->
                              <div>
                                <x-input-label for="floor" :value="__('Floor Number')" />
                                <x-text-input id="floor" name="floor" type="text" class="mt-1 block w-full" :value="old('floor')"  autofocus autocomplete="floor" />
                                <x-input-error class="mt-2" :messages="$errors->get('floor')" />
                            </div>
    
                              <!-- Book Floor -->
                              <div>
                                <x-input-label for="shelf" :value="__('Book Shelf Number')" />
                                <x-text-input id="shelf" name="shelf" type="text" class="mt-1 block w-full" :value="old('shelf')"  autofocus autocomplete="shelf" />
                                <x-input-error class="mt-2" :messages="$errors->get('shelf')" />
                            </div>
        
    
                          
                    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Create') }}</x-primary-button>
                    
                                @if (session('status') === 'book-created')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600 dark:text-gray-400"
                                    >{{ __('New Book Added Successfully.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
