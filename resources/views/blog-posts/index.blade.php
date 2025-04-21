<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Authors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex justify-end">
                        <a href="{{ route('blogposts.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-green-700 transition duration-300">
                            Create BlogPost
                        </a>
                    </div><br>
                    <div class="flex justify-start gap-2">
                        <input 
                            type="radio" name="option" value="1" 
                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['published' => 1]) }}'"
                            {{ (request()->has('published') && request('published') == 1) ? 'checked' : ''}}
                        >
                        <x-input-label for="published" :value="__('Published')" />

                        <input 
                            type="radio" name="option" value="0" 
                            onclick="window.location.href='{{ request()->fullUrlWithQuery(['published' => 0]) }}'"
                            {{ (request()->has('published') && request('published') == 0) ? 'checked' : ''}}
                        >
                        <x-input-label for="unpublished" :value="__('UnPublished')" />
                    </div>
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
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b text-left">#</th>
                                <th class="px-4 py-2 border-b text-left">Title</th>
                                <th class="px-4 py-2 border-b text-left">Content</th>
                                <th class="px-4 py-2 border-b text-left">Author</th>
                                <th class="px-4 py-2 border-b text-left">Created At</th>
                                <th class="px-4 py-2 border-b text-left">Published At</th>
                                <th class="px-4 py-2 border-b text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogposts as $key => $blogpost)
                            <tr>
                                <td class="px-4 py-2 border-b">{{ $key + 1 }}</td>
                                <td  class="px-4 py-2 border-b">{{ $blogpost->title }}</td>
                                <td  class="px-4 py-2 border-b">{{ Str::limit($blogpost->content, 125).'...' }}</td>
                                <td  class="px-4 py-2 border-b">{{ $blogpost->author->name }}</td>
                                <td  class="px-4 py-2 border-b">{{ $blogpost->created_at->format('M d, Y h:i:A') }}</td>
                                <td  class="px-4 py-2 border-b">{{ $blogpost->published_at }}</td>
                                <td  class="px-4 py-2 border-b">
                                    <!-- View Blog Image -->
                                    @if ($blogpost->image_path != '') 
                                    <a href="{{ asset('storage/' . $blogpost->image_path) }}" target="_blank" class="text-blue-600 hover:text-blue-900 px-3 py-1 border rounded">
                                        View Image
                                    </a>
                                    @endif
                                    <!-- View Button -->
                                    <a href="{{ route('blogposts.show', $blogpost->id) }}" class="text-blue-600 hover:text-blue-900 px-3 py-1 border rounded">
                                        View
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="{{ route('blogposts.edit', $blogpost->id) }}" class="text-yellow-600 hover:text-yellow-900 px-3 py-1 border rounded">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('blogposts.destroy', $blogpost->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 px-3 py-1 border rounded" onclick="return confirm('Are you sure you want to delete this blog post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        {{ $blogposts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
