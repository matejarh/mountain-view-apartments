<?php

namespace App\Contracts;

interface CreatesNewProperties
{
    /**
     * Validate and create new property.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
