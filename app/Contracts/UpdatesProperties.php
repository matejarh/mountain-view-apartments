<?php

namespace App\Contracts;
use App\Models\Property;

interface UpdatesProperties
{
    /**
     * Validate and updates new property.
     *
     * @param  array  $input
     * @param  \App\Models\Property  $property
     */
    public function update(Property $property, array $input);
}
