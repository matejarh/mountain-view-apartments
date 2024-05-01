<?php

namespace App\Contracts;
use App\Models\Gallery;
use App\Models\Image;

interface DetachesImagesFromGalleries
{
    /**
     * Detaches given image from given gallery.
     *
     * @param  \App\Models\Image $image
     * @param  \App\Models\Gallery $gallery
     */
    public function detach(Image $image, Gallery $gallery);
}
