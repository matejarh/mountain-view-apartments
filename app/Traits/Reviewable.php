<?php

namespace App\Traits;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;
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

    public function latestReviews() :Collection
    {
        return $this->reviews()->latest()->take(5)->get();
    }

    /**
     * Review current model.
     *
     * @param int $score
     * @param string $text
     * @return void
     */
    public function review(int $score, string $text): void
    {
        if ($this->isReviewed()) {
            session()->flash('flash.banner', __('You have already reviewed this accomodation'));
            session()->flash('flash.bannerStyle', 'danger');
            return;
        }

        $attributes = [
            'user_id' => auth()->id(),
            'score' => $score,
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
    public function isReviewed(): bool
    {
        // Check if a like record exists for the current user
        return $this->reviews()->where('user_id', auth()->id())->exists();
    }

    public function getIsReviewedAttribute( ) :bool
    {
        return $this->isReviewed();
    }

    public function avarageReviewScore(): float
    {
        return round($this->reviews && $this->reviews->count() > 0 ? $this->reviews->average('score') : 0 ,1);
    }

    public function getAverageReviewScoreAttribute(): float|null
    {
        // return 0.5;
        return $this->avarageReviewScore();
    }
}
