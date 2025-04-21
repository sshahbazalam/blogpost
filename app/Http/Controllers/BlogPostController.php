<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\BlogPost;
use App\Services\BlogPostService;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use Illuminate\Support\Facades\Log;

class BlogPostController extends Controller
{
    protected $blogPostService;
    /**
     * Add dependency injection AuthorService
     */
    public function __construct(BlogPostService $blogPostService)
    {
        $this->blogPostService = $blogPostService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blogposts = $this->blogPostService->paginateBlogPosts(5, $request->query());
        return view('blog-posts.index', compact('blogposts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::pluck('name', 'id');
        return view('blog-posts.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogPostRequest $request)
    {
        try {
            $blogPost = $this->blogPostService->createBlogPost($request->validated(), $request);
            //Return response
            return redirect()
                ->route('blogposts.index')
                ->with('success', trans('blogpost_created'));
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error creating blogPost', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the blog post.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogPost $blogpost)
    {
        return view('blog-posts.show', compact('blogpost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $blogpost)
    {
        return view('blog-posts.edit', compact('blogpost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogPostRequest $request, BlogPost $blogpost)
    {
        try {
            $this->blogPostService->updateBlogpost($blogpost, $request);
            //Return response
            return redirect()
                ->route('blogposts.index')
                ->with('success', trans('blogpost_updated'));
        } catch (\Throwable $th) {
            // Log the error
            Log::error('Error updating blog post', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()
                ->withInput()
                ->with('error', 'Failed to update the blog post.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $blogpost)
    {
        try {
            $this->blogPostService->deleteBlogpost($blogpost);
            //Return response
            return redirect()
                ->route('blogposts.index')
                ->with('success', trans('blogpost_deleted'));
        } catch (\Throwable $th) {
            // Log the error
            Log::error('Error deleting blog post', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()->with('error', 'Something went wrong while deleting the blog post.');
        }    
    }
}
