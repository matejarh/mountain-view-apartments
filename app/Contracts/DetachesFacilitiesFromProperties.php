<?php

namespace App\Contracts;
use App\Models\Property;
use App\Models\Facility;

interface DetachesFacilitiesFromProperties
{
    /**
     * Detaches given facility to given gallery.
     *
     * @param  \App\Models\Facility $facility
     * @param  \App\Models\Property $property
     */
    public function detach(Facility $facility, Property $property);
}
