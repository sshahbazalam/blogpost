<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\BlogPost;

class Author extends Model
{
    /** @use HasFactory<\Database\Factories\AuthorFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'bio'
    ];

    /**
     * Get all blog posts of this user
     * 
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function blogPosts():HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
