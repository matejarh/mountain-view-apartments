<?php

namespace App\Contracts;
use App\Models\Image;

interface UpdatesImages
{
    /**
     * Validate and updates new image.
     *
     * @param  array  $input
     * @param  \App\Models\Image  $image
     */
    public function update(Image $image, array $input);
}
