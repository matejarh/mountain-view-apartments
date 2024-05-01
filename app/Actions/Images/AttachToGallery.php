<?php

namespace App\Actions\Images;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesImages;
use App\Contracts\AttachesImagesToGalleries;
use App\Models\Gallery;
use App\Models\Image;

class AttachToGallery implements AttachesGalleriesToImages
{
    /**
     * Attaches given image to given gallery.
     *
     * @param  \App\Models\Image  $image
     * @param  \App\Models\Gallery  $gallery
     */
    public function attach(Gallery $gallery, Image $image ): void
    {
        $image->galleries()->attach($gallery);
    }
}
