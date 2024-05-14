<?php

namespace App\Contracts;
use App\Models\Gallery;

interface ChangesImagesOrder
{
    /**
     * Validate and updates new gallery.
     *
     * @param  array  $input
     * @param  \App\Models\Gallery  $gallery
     */
    public function order(Gallery $gallery, array $input);
}
