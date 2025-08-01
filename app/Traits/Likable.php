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
            //\Log::debug('deleting');
            $model->likes()->delete();
            // $model->decrement('likes_count');
        });

        static::created(function ($model) {
            //\Log::debug('created');
            //$model->increment('likes_count');
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
        $locale = app()->currentLocale();
        if ($this->isLiked()) {
            $this->unlike();
        } else {
            // Like the model if the user hasn't already liked it
            $attributes = ['user_id' => auth()->id()];
            if ($this->likes()->forceCreate($attributes)) {
                $this->increment('likes_count');
                session()->flash('flash.banner', __('You like') . ' ' . $this->title->$locale . '.');
            }
        }
    }

    /**
     * Unlike the current model.
     *
     * @return void
     */
    public function unlike()
    {
        $locale = app()->currentLocale();
        // Delete the like record associated with the current user
        $attributes = ['user_id' => auth()->id()];
        if ($this->likes()->where($attributes)->forceDelete()) {
            try {
                //code...
                // $this->reviewed()->decrement('reviews_count');
                $this->decrement('likes_count');
            } catch (\Illuminate\Database\QueryException $th) {
                //session()->flash('flash.banner', $th->getMessage());
                //session()->flash('flash.bannerStyle', 'danger');
                //throw $th;
            }
            session()->flash('flash.banner', __('You don\'t like '.$this->title->$locale.'.'));
            session()->flash('flash.bannerStyle', 'danger');
        }
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
