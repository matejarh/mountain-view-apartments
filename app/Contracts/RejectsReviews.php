<?php

namespace App\Contracts;
use App\Models\Review;

interface RejectsReviews
{
    /**
     * Rejects given review.
     *
     * @param  \App\Models\Review  $review
     */
    public function reject(Review $review);
}
