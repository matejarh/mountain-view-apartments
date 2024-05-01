<?php

namespace App\Contracts;

interface DeletesGalleries
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Gallery $gallery
     */
    public function destroy(Gallery $gallery);
}
