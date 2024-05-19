<?php

namespace App\Http\Controllers;

use App\Filters\ReviewFilters;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ReviewsController extends Controller
{
    /**
     * Get paginated reviews list for given property
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request
     * @param \App\Filters\ReviewFilters
     * @return \Inertia\Response
     */
    public function index(Request $request, string $lang, Property $property, ReviewFilters $filters): Response
    {
        // Gate::authorize('viewAny', Review::class);

        return Inertia::render('Reviews/Index', [
            'reviews' => $property->reviews()->with('owner')->filter($filters)->latest()->paginate(10, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'property' => $property,
            'filters' => $request->only(['search']),
            'can' => [
                'view_properties' => auth()->check() ? auth()->user()->can('viewAny', Review::class) : false,
            ],
            'seo' => [
                'title' => __('Mountain View Apartments'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }

    /**
     * Get form for create new review
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request
     * @param string $lang
     * @param \App\Models\Property
     * @return \Inertia\Response
     */
    public function create(string $lang, Property $property): Response
    {
        // Gate::authorize('viewAny', Review::class);

        return Inertia::render('Reviews/Create', [
            'property' => $property,
            'can' => [
                'create_reviews' => auth()->check() ? auth()->user()->can('create', Review::class) : false,
            ],
            'seo' => [
                'title' => __('Mountain View Apartments'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }
}
