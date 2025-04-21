<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('BlogPosts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-end gap-2">
                            <!-- Edit Button -->
                            <a href="{{ route('blogposts.edit', $blogpost->id) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-yellow-900 transition duration-300">
                                Edit BlogPost
                            </a>

                            <!-- Delete Button -->
                            <form action="{{ route('blogposts.destroy', $blogpost->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-red-900 transition duration-300" onclick="return confirm('Are you sure you want to delete this blog post?')">Delete</button>
                            </form>
                    </div>
                    <br>
                    <!-- Author Header -->
                    <div class="flex items-center space-x-4">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Title</h2>
                            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $blogpost->title }}</h1>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Author</h2>
                            <p class="text-lg text-gray-500 dark:text-gray-300">{{ $blogpost->author->name }}</p>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Created At</h2>
                            <p class="text-sm text-gray-400 dark:text-gray-500">{{ $blogpost->created_at->diffForHumans() }}</p>
                            <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Published At</h2>
                            <p class="text-sm text-gray-400 dark:text-gray-500">{{ $blogpost->published_at }}</p>
                        </div>
                    </div>

                    <!-- Author Bio Section -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Content</h2>
                        <p class="mt-4 text-gray-700 dark:text-gray-300">{{ $blogpost->content }}</p>
                    </div>

                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Blog Image</h2>
                        @if ($blogpost->image_path)
                            <img src="{{ asset('storage/' . $blogpost->image_path) }}">
                        @endif;    
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
