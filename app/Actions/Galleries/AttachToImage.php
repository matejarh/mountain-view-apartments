<?php

namespace App\Actions\Galleries;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesImagesToGalleries;
use App\Models\Gallery;
use App\Models\Image;

class AttachToImage implements AttachesImagesToGalleries
{
    /**
     * Attaches given gallery to given image.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Models\Image  $image
     */
    public function attach(Image $image, Gallery $gallery): void
    {
        $gallery->images()->attach($image);
    }
}
