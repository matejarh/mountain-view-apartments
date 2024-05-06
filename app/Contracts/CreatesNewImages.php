<?php

namespace App\Contracts;

interface CreatesNewImages
{
    /**
     * Validate and create new image.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
