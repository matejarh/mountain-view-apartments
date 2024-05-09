<?php

namespace App\Contracts;
use App\Models\Property;
use App\Models\Gallery;

interface AttachesGalleriesToProperties
{
    /**
     * Attaches given gallery to given property.
     *
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Property $property
     */
    public function attach(Gallery $gallery, Property $property);
}
