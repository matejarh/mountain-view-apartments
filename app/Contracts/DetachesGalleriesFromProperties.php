<?php

namespace App\Contracts;
use App\Models\Property;
use App\Models\Gallery;

interface DetachesGalleriesFromProperties
{
    /**
     * Detaches given gallery to given property.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Property $property
     */
    public function detach(Gallery $gallery, Property $property);
}
