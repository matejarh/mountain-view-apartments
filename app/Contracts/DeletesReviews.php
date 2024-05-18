<?php

namespace App\Contracts;
use App\Models\Review;

interface DeletesReviews
{
    /**
     * Deletes given review.
     *
     * @param  \App\Models\Review  $review
     */
    public function destroy(Review $review);
}
