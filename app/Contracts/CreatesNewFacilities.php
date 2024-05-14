<?php

namespace App\Contracts;

interface CreatesNewFacilities
{
    /**
     * Validate and create new facility.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
