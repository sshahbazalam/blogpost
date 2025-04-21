<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Author') }}
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
                <form method="POST" action="{{ route('authors.store') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Bio -->
                    <div class="mt-4">
                        <x-input-label for="bio" :value="__('Bio')" />
                        <x-textarea name="bio" rows="5" cols="50"  placeholder="Enter your bio here...">
                            {{ old('bio') }}
                        </x-textarea>
                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>
</x-app-layout>
