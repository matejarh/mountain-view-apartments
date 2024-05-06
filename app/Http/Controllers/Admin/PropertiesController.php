<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesFacilitiesToProperties;
use App\Contracts\CreatesNewProperties;
use App\Contracts\DetachesFacilitiesFromProperties;
use App\Contracts\FacilityAttacheResponse;
use App\Contracts\FacilityDetacheResponse;
use App\Contracts\PropertyCreateResponse;
use App\Contracts\PropertyUpdateResponse;
use App\Contracts\UpdatesProperties;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PropertiesController extends Controller
{
    public function index(Request $request) : Response {
        return Inertia::render('Admin/Properties/Show', [
            'properties' => Property::get(),
        ]);
    }

    /**
     * Creates new property with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewProperties  $creator
     * @return \App\Contracts\PropertyCreateResponse
     */
    public function store(Request $request, CreatesNewProperties $creator): PropertyCreateResponse
    {
        if ($request->user()->cannot('create', Property::class))
            abort(403);

        $creator->create($request->all());

        return app(PropertyCreateResponse::class);
    }


    /**
     * Updates given property with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @param  \App\Contracts\UpdatesProperties  $updater
     * @return \App\Contracts\PropertyUpdateResponse
     */
    public function update(Request $request, Property $property, UpdatesProperties $updater): PropertyUpdateResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $updater->update($property, $request->all());

        return app(PropertyUpdateResponse::class);
    }

    /**
     * Attaches given facility to given property.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Property $property
     * @param  \App\Models\Facility $facility
     * @param  \App\Contracts\AttachesFacilitiesToProperties $attacher
     * @return \App\Contracts\FacilityAttacheResponse
     */
    public function attach(Request $request, Property $property, Facility $facility, AttachesFacilitiesToProperties $attacher): FacilityAttacheResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $attacher->attach($facility, $property);

        return app(FacilityAttacheResponse::class);
    }

    /**
     * Detaches given facility grom given property.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Property $property
     * @param  \App\Models\Facility $facility
     * @param  \App\Contracts\DetachesFacilitiesFromProperties $attacher
     * @return \App\Contracts\FacilityDetacheResponse
     */
    public function detach(Request $request, Property $property, Facility $facility, DetachesFacilitiesFromProperties $attacher): FacilityDetacheResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $attacher->detach($facility, $property);

        return app(FacilityDetacheResponse::class);
    }
}
