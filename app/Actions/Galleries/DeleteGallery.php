<?php

namespace App\Actions\Gallerys;

use App\Contracts\DeletesGalleries;
use App\Models\Gallery;

class DeleteGallery implements DeletesGalleries
{
    /**
     * Deletes given gallery.
     *
     * @param  \App\Models\Gallery  $gallery
     */
    public function destroy(Gallery $gallery): void
    {
        $gallery->delete();
    }
}
