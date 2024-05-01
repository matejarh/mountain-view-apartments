<?php

namespace App\Contracts;

interface DeletesImages
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Image $image
     */
    public function destroy(Image $image);
}
