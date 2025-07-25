<?php

namespace App\Contracts;
use App\Models\Gallery;

interface UpdatesGalleries
{
    /**
     * Validate and updates new gallery.
     *
     * @param  array  $input
     * @param  \App\Models\Gallery  $gallery
     */
    public function update(Gallery $gallery, array $input);
}
