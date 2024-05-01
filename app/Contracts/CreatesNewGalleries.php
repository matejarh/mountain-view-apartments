<?php

namespace App\Contracts;

interface CreatesNewGalleries
{
    /**
     * Validate and create new gallery.
     *
     * @param  array  $input
     * @return \App\Models\Gallery
     */
    public function create(array $input);
}
