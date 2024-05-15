<?php

namespace App\Traits;

use App\Models\Like;

trait Likable
{
    /**
     * Boot the trait.
     */
    public static function bootLikable()
    {
        static::deleting(function ($model) {
            // Delete all likes associated with the model
            $model->likes()->delete();

            // Decrement the likes count when the model is deleted
            $model->decrement('likes_count');
        });

        static::created(function ($model) {
            // Increment the likes count when a new model instance is created
            $model->increment('likes_count');
        });
    }

    /**
     * Get all likes associated with the likable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    /**
     * Like the current model.
     * If the user has already liked the model, it will unlike it.
     *
     * @return void
     */
    public function like()
    {
        if ($this->isLiked()) {
            $this->unlike();
        } else {
            // Like the model if the user hasn't already liked it
            $attributes = ['user_id' => auth()->id()];
            $this->likes()->create($attributes);
        }
    }

    /**
     * Unlike the current model.
     *
     * @return void
     */
    public function unlike()
    {
        // Delete the like record associated with the current user
        $attributes = ['user_id' => auth()->id()];
        $this->likes()->where($attributes)->delete();
    }

    /**
     * Check if the current user has liked the model.
     *
     * @return bool
     */
    public function isLiked()
    {
        // Check if a like record exists for the current user
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    /**
     * Get the value indicating whether the current user has liked the model.
     *
     * @return bool
     */
    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }
}
