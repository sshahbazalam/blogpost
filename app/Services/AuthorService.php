<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    /**
     * Get Authors using pagination
     */
    public function getAllAuthorsPaginated(int $perPage = 10): mixed
    {
        return Author::latest()->paginate($perPage);
    }

    /**
     * Store Author in table
     * 
     * @param array $data
     * @return Author
     */
    public function createAuthor(array $data): Author
    {
        return Author::create($data);
    }

    /**
     * Get Author by Id
     * 
     * @param int $id
     * @return Author
     */
    public function getAuthorById(int $id): Author
    {
        return Author::findOrFail($id);
    }

    /**
     * Update Author
     * 
     * @param Author $author author object
     * @parame array $data data is going to update
     * @return bool
     */
    public function updateAuthor(Author $author, array $data): bool
    {
        return $author->update($data);
    }

    /**
     * Update Author by Id
     * 
     * @param int $id author id
     * @param array $data data is going to update
     * @return Author
     */
    public function updateAuthorById(int $id, array $data): Author
    {
        $author = Author::findOrFail($id);
        $author->update($data);
        return $author;
    }

    /**
     * Delete Author
     * 
     * @param Author $author
     * @return bool 
     */
    public function deleteAuthor(Author $author): bool
    {
        return $author->delete();
    }

    /**
     * Delete Author by id
     * 
     * @param $id author id
     * @return bool 
     */
    public function deleteAuthorById(int $id): bool
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return true;
    }
}
