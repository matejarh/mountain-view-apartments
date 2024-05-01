<?php

namespace App\Contracts;
use App\Models\Gallery;
use App\Models\Image;

interface AttachesGalleriesToImages
{
    /**
     * Attaches given gallery to given image.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Image $image
     */
    public function attach(Gallery $gallery, Image $image);
}
