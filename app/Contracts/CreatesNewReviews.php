<?php

namespace App\Contracts;
use App\Models\Property;

interface CreatesNewReviews
{
    /**
     * Validate and create new review.
     *
     * @param  \App\Models\Property $property
     * @param  array  $input
     */
    public function create(Property $property, array $input);
}
