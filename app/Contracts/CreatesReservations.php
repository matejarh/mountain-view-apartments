<?php

namespace App\Contracts;
use App\Models\Property;

interface CreatesReservations
{
    /**
     * Stores new reservation for given property.
     *
     * @param  array $input
     * @param  \App\Models\Property $property
     */
    public function create(Property $property, array $input);
}
