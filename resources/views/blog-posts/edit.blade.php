<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Blog Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 5000)" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-md shadow-md flex items-center justify-between mb-4"
                >
                    <div class="flex items-center">
                        <!-- Icon -->
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 00-2 0v4a1 1 0 002 0V7zm-1 8a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base font-medium">
                            {{ session('success') }}
                        </span>
                    </div>

                    <!-- Close Button -->
                    <button @click="show = false" class="text-green-700 hover:text-green-900 ml-4 text-xl leading-none">
                        &times;
                    </button>
                </div>
                @endif
                @if (session('error'))
                <div 
                    x-data="{ show: true }" 
                    x-init="setTimeout(() => show = false, 5000)" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-md shadow-md flex items-center justify-between mb-4"
                >
                    <div class="flex items-center">
                        <!-- Icon -->
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 00-2 0v4a1 1 0 002 0V7zm-1 8a1.5 1.5 0 110-3 1.5 1.5 0 010 3z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base font-medium">
                            {{ session('errror') }}
                        </span>
                    </div>

                    <!-- Close Button -->
                    <button @click="show = false" class="text-green-700 hover:text-green-900 ml-4 text-xl leading-none">
                        &times;
                    </button>
                </div>
                @endif
                <form method="POST" action="{{ route('blogposts.update', $blogpost) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')" />
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$blogpost->title" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <x-input-label for="content" :value="__('Content')" />
                        <x-textarea name="content" rows="5" cols="50"  placeholder="Enter your content here..." :value="$blogpost->content">
                            {{ $blogpost->content }}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <!-- Authors -->
                    
                    <div class="flex justify-start gap-2">
                        <!-- Published -->
                        <input 
                            type="radio" name="published" value="1" 
                            {{ $blogpost->published_at != '' ? 'checked' : ''}}
                        >
                        <x-input-label for="published" :value="__('Published')" />

                        <input 
                            type="radio" name="published" value="0" 
                            {{ $blogpost->published_at == '' ? 'checked' : ''}}
                        >
                        <x-input-label for="unpublished" :value="__('UnPublished')" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="image" :value="__('Blog Image')" />
                        <input type="file" name="image" accept="image/*" class="mt-2 mb-4 block">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Blog Existing Image</h2>
                    @if ($blogpost->image_path)
                        <img src="{{ asset('storage/' . $blogpost->image_path) }}">
                        @else
                            Not yet added
                    @endif;


                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</x-app-layout>
