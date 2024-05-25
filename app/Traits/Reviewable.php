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
            //$model->decrement('reviews_count');
        });

        static::created(function ($model) {
            // Increment the reviews count when a new model instance is created
           // $model->increment('reviews_count');
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
        return $this->reviews()->approved()->latest()->take(10)->get();
    }

    public function approvedReviews() :Collection
    {
        return $this->reviews()->approved()->get();
    }

    /**
     * Review current model.
     *
     * @param int $score
     * @param string $text
     * @return void
     */
    public function review(int $score, string $text): Review|null
    {
        if ($this->isReviewed()) {
            session()->flash('flash.banner', __('You have already reviewed this accomodation'));
            session()->flash('flash.bannerStyle', 'danger');
            return null;
        }

        $attributes = [
            'user_id' => auth()->id(),
            'score' => $score,
            'text' => $text,
        ];

        return $this->reviews()->forceCreate($attributes);
    }

    /**
     * Remove review from given user for the current model.
     *
     * @return void
     */
    public function unreview(int $id): void
    {
        $review = $this->reviews()->find($id);

        if ($review->approved_at) {
            try {
                //code...
                // $this->reviewed()->decrement('reviews_count');
                $this->decrement('reviews_count');
            } catch (\Illuminate\Database\QueryException $th) {
                //session()->flash('flash.banner', $th->getMessage());
                //session()->flash('flash.bannerStyle', 'danger');
                //throw $th;
            }
        }

        $review->delete();
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
        return round($this->approvedReviews()->average('score') | 0);
    }

    public function getAverageReviewScoreAttribute(): float|null
    {
        // return 0.5;
        return $this->avarageReviewScore();
    }

    public function getApprovedReviewsAttribute() :Collection
    {
        return $this->approvedReviews();
    }
}
