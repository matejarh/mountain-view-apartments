<?php

namespace App\Traits;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reviewable
{
    /**
     * Boot the trait.
     */
    public static function bootReviewable()
    {
        static::deleting(function ($model) {
            // Delete all reviews associated with the model
            $model->reviews()->delete();

            // Decrement the reviews count when the model is deleted
            $model->decrement('reviews_count');
        });

        static::created(function ($model) {
            // Increment the reviews count when a new model instance is created
            $model->increment('reviews_count');
        });
    }

    /**
     * Get all reviews associated with the reviewable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewed');
    }

    /**
     * Review current model.
     *
     * @param int $rating
     * @param string $text
     * @return void
     */
    public function review(int $rating, string $text): void
    {
        if ($this->isReviewed()) {
            session()->flash('flash.banner', 'You have already reviewed this accomodation');
            session()->flash('flash.bannerStyle', 'danger');
            return;
        }

        $attributes = [
            'user_id' => auth()->id(),
            'rating' => $rating,
            'text' => $text,
        ];

        $this->reviews()->forceCreate($attributes);
    }

    /**
     * Remove review from given user for the current model.
     *
     * @return void
     */
    public function unreview(int $id): void
    {
        $this->reviews()->find($id)->delete();
    }


    /**
     * Check if the current user has reviewed the model.
     *
     * @return bool
     */
    public function isReviewed()
    {
        // Check if a like record exists for the current user
        return $this->reviews()->where('user_id', auth()->id())->exists();
    }
}
