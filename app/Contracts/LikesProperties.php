<?php

namespace App\Contracts;
use App\Models\Property;

interface LikesProperties
{
    /**
     * Likes givem property.
     *
     * @param  \App\Models\Property $property
     */
    public function like(Property $property);
}
