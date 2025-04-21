<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthorService;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Api\StoreAuthorRequest;
use App\Http\Requests\Api\UpdateAuthorRequest;

class AuthorController extends Controller
{
    protected $authorService;

    /**
     * Add service as dependency injection
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
            return $this->successApiResponse(trans('authors_retrieved'), $this->authorService->getAllAuthorsPaginated($perPage));
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error getting authors', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return $this->errorApiResponse('Unable to get authors', $th->getMessage(), 500);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
        try {
            $author = $this->authorService->createAuthor($request->validated());
            //Return response
            return $this->successApiResponse(trans('author_created'), $author, 201);
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error creating author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return $this->errorApiResponse('Unable to create author', $th->getMessage(), 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $author = $this->authorService->getAuthorById($id);
            return $this->successApiResponse(trans('author_retrieved'), $author);
        } catch (\Throwable $th) {
            // Log the error (important for debugging)
            Log::error('Error getting author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return $this->errorApiResponse('Unable to get author', $th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, int $id)
    {
        try {
            $author = $this->authorService->updateAuthorById($id, $request->validated());
            //Return response
            return $this->successApiResponse(trans('author_updated'), $author);
        } catch (\Throwable $th) {
            // Log the error
            Log::error('Error updating author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return $this->errorApiResponse('Unable to update author', $th->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->authorService->deleteAuthorById($id);
            //Return response
            return $this->successApiResponse(trans('author_deleted'));
        } catch (\Throwable $th) {
            // Log the error for debuggig in production
            Log::error('Error deleting author', [
                'message' => $th->getMessage(),
                'stack' => $th->getTraceAsString(),
            ]);
            //Return response
            return $this->errorApiResponse('Unable to delete author', $th->getMessage(), 500);
        }
    }
}
