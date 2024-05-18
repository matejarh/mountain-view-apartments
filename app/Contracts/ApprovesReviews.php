<?php

namespace App\Contracts;
use App\Models\Review;

interface ApprovesReviews
{
    /**
     * Approves given review.
     *
     * @param  \App\Models\Review  $review
     */
    public function approve(Review $review);
}
