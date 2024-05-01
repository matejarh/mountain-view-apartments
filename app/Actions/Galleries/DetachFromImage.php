<?php

namespace App\Actions\Galleries;

use App\Contracts\DetachesImagesFromGalleries;
use App\Models\Gallery;
use App\Models\Image;

class DetachFromImage implements DetachesImagesFromGalleries
{
    /**
     * Attaches given gallery to given image.
     *
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Models\Image  $image
     */
    public function detach( Image $image, Gallery $gallery): void
    {
        $gallery->images()->detach($image);
    }
}
