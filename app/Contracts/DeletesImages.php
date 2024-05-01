<?php

namespace App\Contracts;
use App\Models\Image;

interface DeletesImages
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Image $image
     */
    public function destroy(Image $image);
}
