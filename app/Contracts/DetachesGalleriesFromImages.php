<?php

namespace App\Contracts;
use App\Models\Gallery;
use App\Models\Image;

interface DetachesGalleriesFromImages
{
    /**
     * Detaches given gallery from given image.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Image $image
     */
    public function detach(Gallery $gallery, Image $image);
}
