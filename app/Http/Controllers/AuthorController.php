<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Services\AuthorService;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;
    /**
     * Add dependency injection AuthorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $perPage = $request->query('per_page', 10);
            $authors = $this->authorService->getAllAuthorsPaginated($perPage);
            //Return response
            return view('authors.index', compact('authors'));
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error getting author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()
                ->with('error', 'Something went wrong while getting the authors.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        try {
            $author = $this->authorService->createAuthor($request->validated());
            //Return response
            return redirect()
                ->route('authors.index')
                ->with('success', trans('author_created'));
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error creating author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()
                ->withInput()
                ->with('error', 'Something went wrong while creating the author.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        try {
            $this->authorService->updateAuthor($author, $request->validated());
            //Return response
            return redirect()
                ->route('authors.index')
                ->with('success', trans('author_updated'));
        } catch (\Throwable $th) {
            // Log the error
            Log::error('Error updating author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()
                ->withInput()
                ->with('error', 'Failed to update the author.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        try {
            $this->authorService->deleteAuthor($author);
            //Return response
            return redirect()
                ->route('authors.index')
                ->with('success', trans('author_deleted'));
        } catch (\Throwable $th) {
            // Log the error for debuggig in production
            Log::error('Error deleting author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return back()->with('error', 'Something went wrong while deleting the author.');
        }
    }
}
