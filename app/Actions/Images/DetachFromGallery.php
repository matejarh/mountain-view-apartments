<?php

namespace App\Actions\Images;

use App\Contracts\DetachesGalleriesFromImages;
use App\Contracts\DetachesImagesFromGalleries;
use App\Models\Gallery;
use App\Models\Image;

class DetachFromGallery implements DetachesGalleriesFromImages
{
    /**
     * Detaches given image from given gallery.
     *
     * @param  \App\Models\Image  $image
     * @param  \App\Models\Gallery  $gallery
     */
    public function detach(Gallery $gallery, Image $image ): void
    {
        $image->galleries()->detach($gallery);
    }
}
