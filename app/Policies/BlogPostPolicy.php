<?php

namespace App\Policies;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPostPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogPost $blogpost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //Now every user can create blog post, but might be in future role wise we allowed to create
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogPost $blogpost): bool
    {
        //For authorization, if we added userId on blogPost table so we compare like below
        //return $user->id == $blogpost->user_id
        //But we don't have user_id in author table, so direct return true
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogPost $blogpost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogPost $blogPost): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogPost $blogPost): bool
    {
        return false;
    }
}
