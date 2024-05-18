<?php

namespace App\Actions\Reviews;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\RejectsReviews;


class RejectsReview implements RejectsReviews
{
    /**
     * Rejects given review
     *
     * @param  \App\Models\Review  $review
     * @param  array<string, string>  $input
     */
    public function reject(Review $review): void
    {
        $review->reject();

        session()->flash('flash.banner', __('Review has been rejected.'));
    }
}
