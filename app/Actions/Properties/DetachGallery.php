<?php

namespace App\Actions\Properties;

use App\Contracts\DetachesGalleriesFromProperties;
use App\Models\Gallery;
use App\Models\Property;

class DetachGallery implements DetachesGalleriesFromProperties
{
    /**
     * Attaches given property to given gallery.
     *
     * @param  \App\Models\Property  $property
     * @param  \App\Models\Gallery  $gallery
     */
    public function detach( Gallery $gallery, Property $property): void
    {
        $property->galleries()->detach($gallery);

        session()->flash('flash.banner', __('Gallery has been detached from the property.'));
    }
}
