<?php

namespace App\Contracts;
use App\Models\Review;

interface UpdatesReviews
{
    /**
     * Validate and update given review.
     *
     * @param  array  $input
     * @param  \App\Models\Review  $review
     */
    public function update(Review $review, array $input);
}
