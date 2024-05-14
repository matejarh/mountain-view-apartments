<?php

namespace App\Contracts;
use App\Models\Gallery;

interface ReordersImagesList
{
    /**
     * Reorders images from given gallery.
     *
     * @param  array  $input
     * @param  \App\Models\Gallery $gallery
     */
    public function order(Gallery $gallery, array $input);
}
