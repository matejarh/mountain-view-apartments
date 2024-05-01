<?php

namespace App\Contracts;

interface CreatesNewImages
{
    /**
     * Validate and create new image.
     *
     * @param  array  $input
     * @return \App\Models\Image
     */
    public function create(array $input);
}
