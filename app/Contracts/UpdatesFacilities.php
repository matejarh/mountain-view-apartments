<?php

namespace App\Contracts;
use App\Models\Facility;

interface UpdatesFacilities
{
    /**
     * Validate and updates new facility.
     *
     * @param  array  $input
     * @param  \App\Models\Facility  $facility
     */
    public function update(Facility $facility, array $input);
}
