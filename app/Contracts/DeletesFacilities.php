<?php

namespace App\Contracts;
use App\Models\Facility;

interface DeletesFacilities
{
    /**
     * Destroyes given image.
     *
     * @param  \App\Models\Facility $gallery
     */
    public function destroy(Facility $gallery);
}
