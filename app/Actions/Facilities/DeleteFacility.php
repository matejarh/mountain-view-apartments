<?php

namespace App\Actions\Facilities;

use App\Contracts\DeletesFacilities;
use App\Models\Facility;

class DeleteFacility implements DeletesFacilities
{
    /**
     * Deletes given facility.
     *
     * @param  \App\Models\Facility  $facility
     */
    public function destroy(Facility $facility): void
    {
        $facility->delete();

        session()->flash('flash.banner', __('Facility has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
