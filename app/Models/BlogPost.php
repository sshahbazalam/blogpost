<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Author;

class BlogPost extends Model
{
    /** @use HasFactory<\Database\Factories\BlogPostFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'author_id',
        'image_path',
        'published_at'
    ];

    /**
     * Get author of this post
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author():BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Filter published posts
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Filter unpublished posts
     */
    public function scopeUnpublished($query)
    {
        return $query->whereNull('published_at');
    }
}
