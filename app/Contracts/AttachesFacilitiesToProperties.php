<?php

namespace App\Contracts;
use App\Models\Property;
use App\Models\Facility;

interface AttachesFacilitiesToProperties
{
    /**
     * Attaches given facility to given gallery.
     *
     * @param  \App\Models\Facility $facility
     * @param  \App\Models\Property $property
     */
    public function attach(Facility $facility, Property $property);
}
