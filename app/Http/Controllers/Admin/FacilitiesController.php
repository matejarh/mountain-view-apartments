<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewFacilities;
use App\Contracts\DeletesFacilities;
use App\Contracts\FacilityCreateResponse;
use App\Contracts\FacilityDeleteResponse;
use App\Contracts\FacilityUpdateResponse;
use App\Contracts\UpdatesFacilities;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FacilitiesController extends Controller
{
    /**
     * Creates new facility with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewFacilities  $creator
     * @return \App\Contracts\FacilityCreateResponse
     */
    public function store(Request $request, CreatesNewFacilities $creator): FacilityCreateResponse
    {
        Gate::authorize('create', Facility::class);

        $creator->create($request->all());

        return app(FacilityCreateResponse::class);
    }

    /**
     * Updates given facility with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @param  \App\Contracts\UpdatesFacilities  $updater
     * @return \App\Contracts\FacilityUpdateResponse
     */
    public function update(Request $request, Facility $facility, UpdatesFacilities $updater): FacilityUpdateResponse
    {
        Gate::authorize('update', $facility);

        $updater->update($facility, $request->all());

        return app(FacilityUpdateResponse::class);
    }


    /**
     * Destroyes given facility.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Facility $facility
     * @param  \App\Contracts\DeletesFacilities $destroyer
     * @return \App\Contracts\FacilityDeleteResponse
     */
    public function destroy(Request $request, Facility $facility, DeletesFacilities $destroyer): FacilityDeleteResponse
    {
        Gate::authorize('update', $facility);

        $destroyer->destroy($facility);

        return app(FacilityDeleteResponse::class);
    }
}
