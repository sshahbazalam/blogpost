<?php

namespace App\Services;

use App\Models\BlogPost;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogPostRequest;

class BlogPostService
{
    /**
     * Get Authors using pagination
     */
    public function paginateBlogPosts(int $perPage = 5, array $filters)
    {
        $query = BlogPost::query();

        if (isset($filters['published'])) {
            if ($filters['published']) {
                $query->published();
            } else {
                $query->unpublished();
            }
        }

        return $blogPosts = $query->latest()->paginate($perPage)->appends($filters);
    }

    /**
     * Store BlogPost in table
     * 
     * @param array $data
     * @return array $author
     */
    public function createBlogpost(array $data, $request): BlogPost
    {
        //Store image
        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('blogposts', 'public');
        }

        return BlogPost::create($data);
    }

    /**
     * Update BlogPost
     * 
     * @param BlogPost $blogpost blogpost object
     * @parame array $data data is going to update
     * @return bool
     */
    public function updateBlogpost(BlogPost $blogpost, updateBlogPostRequest $request): bool
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($blogpost->image_path) {
                Storage::disk('public')->delete($blogpost->image_path);
            }
            $data['image_path'] = $request->file('image')->store('blogposts', 'public');
        }
        
        //If published clicked
        if ($blogpost->published_at == '' && $data['published']) {
            $data['published_at'] = now();
        }
        unset($data['published']);

        return $blogpost->update($data);
    }

    /**
     * Delete Blogpost
     * 
     * @param Author $author
     * @return bool 
     */
    public function deleteBlogpost(BlogPost $blogpost): bool
    {
        //Delete blog image
        if ($blogpost->image_path) {
            if (Storage::disk('public')->exists($blogpost->image_path)) {
                Storage::disk('public')->delete($blogpost->image_path);
            }
        }

        return $blogpost->delete();
    }
}
