<?php

namespace App\Http\Controllers;

use App\Filters\PropertyFilters;
use App\Models\Property;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PropertiesController extends Controller
{
    /**
     * Get paginated properties list
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request
     * @param \App\Filters\PropertyFilters
     * @return \Inertia\Response
     */
    public function index(Request $request, PropertyFilters $filters): Response
    {
        // Gate::authorize('viewAny', Property::class);

        return Inertia::render('Properies/Index', [
            'properties' => Property::with('galleries', 'facilities')->latest()->filter($filters)->paginate(10, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_properties' => auth()->check() ? auth()->user()->can('viewAny', Property::class) : false,
            ],
        ]);
    }

    /**
     * Display the specified property.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string   $lang
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $lang, Property $property): Response
    {

        // Render the property details page using Inertia.js
        return Inertia::render('Properies/Show', [
            // Pass the property details along with its galleries and facilities
            'property' => $property->with('galleries', 'facilities')->first(),
            // Determine the user's permissions for this property
            'can' => [
                'view_property' => auth()->check() ? auth()->user()->can('view', $property) : false,
                'edit_property' => auth()->check() ? auth()->user()->can('update', $property) : false,
                'delete_property' => auth()->check() ? auth()->user()->can('delete', $property) : false,
            ],
        ]);
    }
}
