<?php

namespace App\Actions\Properties;

use App\Contracts\DetachesFacilitiesFromProperties;
use App\Models\Facility;
use App\Models\Property;

class DetachFacility implements DetachesFacilitiesFromProperties
{
    /**
     * Attaches given property to given facility.
     *
     * @param  \App\Models\Property  $property
     * @param  \App\Models\Facility  $facility
     */
    public function detach( Facility $facility, Property $property): void
    {
        $property->facilities()->detach($facility);

        session()->flash('flash.banner', __('Facility has been detached from the property.'));
    }
}
