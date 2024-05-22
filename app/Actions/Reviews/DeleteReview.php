<?php

namespace App\Actions\Reviews;

use App\Contracts\DeletesReviews;
use App\Models\Review;

class DeleteReview implements DeletesReviews
{
    /**
     * Deletes given review.
     *
     * @param  \App\Models\Review  $review
     */
    public function destroy(Review $review): void
    {
        if ($review->approved_at) {
            $review->reviewed()->decrement('reviews_count');
        }
        $review->delete();

        session()->flash('flash.banner', __('Review has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
