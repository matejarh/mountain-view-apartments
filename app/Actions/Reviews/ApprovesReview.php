<?php

namespace App\Actions\Reviews;

use App\Models\Review;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ApprovesReviews;


class ApprovesReview implements ApprovesReviews
{
    /**
     * Approves given review
     *
     * @param  \App\Models\Review  $review
     * @param  array<string, string>  $input
     */
    public function approve(Review $review): void
    {
        $review->approve();

        session()->flash('flash.banner', __('Review has been approved.'));
    }
}
