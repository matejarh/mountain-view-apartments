<?php

namespace App\Contracts;
use App\Models\Property;

interface ReviewsProperties
{
    /**
     * Reviews given property.
     *
     * @param  array  $input
     * @param  \App\Models\Property  $property
     */
    public function review(Property $property, array $input);
}
