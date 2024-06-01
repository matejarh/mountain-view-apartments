<?php

namespace App\Contracts;
use App\Models\Property;

interface CreatesPrices
{
    /**
     * Validate and create new price for given propertyy.
     *
     * @param \App\Models\Property $property
     * @param  array  $input
     */
    public function create(Property $property, array $input);
}
