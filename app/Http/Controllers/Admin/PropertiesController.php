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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, PropertyFilters $filters): Response
    {
        Gate::authorize('viewAny', Property::class);

        return Inertia::render('Admin/Properties/Index', [
            'properties' => Property::with('galleries', 'facilities')->latest()->filter($filters)->paginate(10, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_properties' => auth()->user()->can('viewAny', Property::class),
            ],
        ]);
    }

    /**
     * Display the specified property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Property $property): Response
    {
        // Check if the user has permission to view the property
        Gate::authorize('view', $property);

        // Render the property details page using Inertia.js
        return Inertia::render('Admin/Properties/Show', [
            // Pass the property details along with its galleries and facilities
            'property' => fn() => Property::with('galleries', 'facilities', 'prices')->find($property->id),

            'icon_list' => $this->fetchIconsList(),

            'defined_dates' => $property->getDatesWithDefinedPrices(now(), now()->addYears(5)),

            // Retrieve facilities not currently associated with the property
            'facilities_not_in_property' => fn() => Facility::all()->intersect(
                Facility::whereNotIn('id', $property->facilities->pluck('id')->toArray())->get()
            ),

            // Retrieve galleries not currently associated with the property, including their images
            'galleries_not_in_property' => fn() => Gallery::with('images')->get()->intersect(
                Gallery::whereNotIn('id', $property->galleries->pluck('id')->toArray())->get()
            ),

            // Determine the user's permissions for this property
            'can' => [
                'view_property' => auth()->user()->can('view', $property),
                'edit_property' => auth()->user()->can('update', $property),
                'delete_property' => auth()->user()->can('delete', $property),
            ],
        ]);
    }

    /**
     * This method is responsible for fetching a list of icons from a specified directory and formatting the filenames and labels.
     *
     * @return \Illuminate\Support\Collection Object
     * (
     *    [items:protected] => Array
     *        (
     *            [IconName1] => Icon Name 1
     *            [IconName2] => Icon Name 2
     *            ...
     *        )
     * )
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function fetchIconsList(): Collection
    {
        Gate::authorize('viewAny', Property::class);

        return cache()->rememberForever('iconList', function () {
            // Convert the array to a collection
            return $this->scanIconDirectory();
        });
    }

    protected function scanIconDirectory() : Collection
    {
        $path = "/resources/js/Icons";

        // Append your output to the file

        // Get all files in the directory
        $files = array_diff(scandir(base_path() . $path), ['.', '..']);
        // Remove the file extension and format the filenames
        $formattedFiles = array_map(function ($file) {
            //Storage::append($filePath, $file);
            $file = str_replace('.vue', '', $file);
            return [
                'name' => $file,
                'label' => preg_replace('/(?<!^)([A-Z])/', ' $1', $file)
            ];
        }, $files);

        // Filter out the 'DinamicIcon' file
        $formattedFiles = array_filter($formattedFiles, function ($file) {
            return $file['name'] !== 'DinamicIcon';
        });

        return collect($formattedFiles);
    }

    protected function writeIconListToFile($list): void
    {
        $filePath = 'iconlist.txt';

        if (!Storage::exists($filePath)) {
            // If the file doesn't exist, create it
            Storage::put($filePath, '');
        }

        array_map(function ($file) use ($filePath) {
            Storage::append($filePath, $file);
        }, $list);
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
