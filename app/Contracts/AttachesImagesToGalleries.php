<?php

namespace App\Contracts;
use App\Models\Gallery;
use App\Models\Image;

interface AttachesImagesToGalleries
{
    /**
     * Attaches given image to given gallery.
     *
     * @param  \App\Models\Image $image
     * @param  \App\Models\Gallery $gallery
     */
    public function attach(Image $image, Gallery $gallery);
}
