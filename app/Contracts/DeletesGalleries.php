<?php

namespace App\Contracts;
use App\Models\Gallery;

interface DeletesGalleries
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Gallery $gallery
     */
    public function destroy(Gallery $gallery);
}
