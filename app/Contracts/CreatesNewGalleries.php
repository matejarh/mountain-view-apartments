<?php

namespace App\Contracts;

interface CreatesNewGalleries
{
    /**
     * Validate and create new gallery.
     *
     * @param  array  $input
     */
    public function create(array $input);
}
