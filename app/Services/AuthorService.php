<?php

namespace App\Services;

use App\Models\Author;

class AuthorService
{
    /**
     * Get Authors using pagination
     */
    public function paginateAuthors(int $perPage = 5)
    {
        return Author::latest()->paginate($perPage);
    }

    /**
     * Store Author in table
     * 
     * @param array $data
     * @return array $author
     */
    public function createAuthor(array $data): Author
    {
        return Author::create($data);
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
     * Delete Author
     * 
     * @param Author $author
     * @return bool 
     */
    public function deleteAuthor(Author $author): bool
    {
        return $author->delete();
    }
}
