<?php

namespace App\Contracts;
use App\Models\Property;

interface CreatesNewInquiries
{
    /**
     * Stores new inquiry for given property.
     *
     * @param  array $input
     * @param  \App\Models\Property $property
     */
    public function create(Property $property, array $input);
}
