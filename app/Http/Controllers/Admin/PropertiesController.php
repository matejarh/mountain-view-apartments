<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesFacilitiesToProperties;
use App\Contracts\AttachesGalleriesToProperties;
use App\Contracts\CreatesNewProperties;
use App\Contracts\DetachesFacilitiesFromProperties;
use App\Contracts\DetachesGalleriesFromProperties;
use App\Contracts\FacilityAttacheResponse;
use App\Contracts\FacilityDetacheResponse;
use App\Contracts\GalleryAttacheResponse;
use App\Contracts\GalleryDetacheResponse;
use App\Contracts\PropertyCreateResponse;
use App\Contracts\PropertyUpdateResponse;
use App\Contracts\UpdatesProperties;
use App\Filters\PropertyFilters;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PropertiesController extends Controller
{
    /**
     * Get filtered ordered paginated properties collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request
     * @param \App\Filters\PropertyFilters
     * @return \Inertia\Response
     */
    public function index(Request $request, PropertyFilters $filters): Response
    {
        if ($request->user()->cannot('viewAny', Property::class))
            abort(403);

        return Inertia::render('Admin/Properties/Index', [
            'properties' => Property::with('galleries', 'facilities')->latest()->filter($filters)->paginate(10, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_properties' => auth()->user()->can('viewAny', Property::class),
            ],
        ]);
    }

    /**
     * Renders and returns given property page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Inertia\Response
     */
    public function show(Request $request, Property $property): Response
    {
        if (auth()->user()->cannot('view', $property))
            abort(403);

        return Inertia::render('Admin/Properties/Show', [
            'property' => $property->with('galleries', 'facilities')->first(),
            'facilities_not_in_property' => Facility::all()->intersect(Facility::whereNotIn('id', $property->facilities->pluck('id')->toArray())->get()),
            'galleries_not_in_property' => Gallery::with('images')->get()->intersect(Gallery::whereNotIn('id', $property->galleries->pluck('id')->toArray())->get()),
            'can' => [
                'view_property' => auth()->user()->can('view', $property),
                'edit_property' => auth()->user()->can('update', $property),
                'delete_property' => auth()->user()->can('delete', $property),
            ],
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
    public function attachFacility(Request $request, Property $property, Facility $facility, AttachesFacilitiesToProperties $attacher): FacilityAttacheResponse
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
    public function detachFacility(Request $request, Property $property, Facility $facility, DetachesFacilitiesFromProperties $attacher): FacilityDetacheResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $attacher->detach($facility, $property);

        return app(FacilityDetacheResponse::class);
    }

    /**
     * Attaches given gallery to given property.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Property $property
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Contracts\AttachesGalleriesToProperties $attacher
     * @return \App\Contracts\GalleryAttacheResponse
     */
    public function attachGallery(Request $request, Property $property, Gallery $gallery, AttachesGalleriesToProperties $attacher): GalleryAttacheResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $attacher->attach($gallery, $property);

        return app(GalleryAttacheResponse::class);
    }

    /**
     * Detaches given gallery grom given property.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Property $property
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Contracts\DetachesGalleriesFromProperties $attacher
     * @return \App\Contracts\GalleryDetacheResponse
     */
    public function detachGallery(Request $request, Property $property, Gallery $gallery, DetachesGalleriesFromProperties $attacher): GalleryDetacheResponse
    {
        if ($request->user()->cannot('update', $property))
            abort(403);

        $attacher->detach($gallery, $property);

        return app(GalleryDetacheResponse::class);
    }
}
