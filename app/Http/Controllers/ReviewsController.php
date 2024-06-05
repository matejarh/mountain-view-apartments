<?php

namespace App\Http\Controllers;

use App\Filters\ReviewFilters;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
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
            'reviews' => $property->reviews()->with('owner')->approved()->filter($filters)->paginate(10, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'property' => $property,
            'filters' => $request->only(['search']),
            'can' => [
                'view_properties' => auth()->check() ? auth()->user()->can('viewAny', Review::class) : false,
                'create_properties' => auth()->check() ? auth()->user()->can('create', Review::class) : false,
            ],
            'seo' => [
                'title' => __('Reviews'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }

    public function myIndex(Request $request, string $lang) :Response
    {
        return Inertia::render('MyReviews/Index', [
            'reviews' => auth()->user()->reviews->paginate(10, null,null, __('page'))->onEachSide(2)->withQueryString(),
            'can' => [
                'view_reviews' => auth()->check() ? auth()->user()->can('view', Review::class) : false,
                'create_review' => auth()->check() ? auth()->user()->can('create', Review::class) : false,
            ],
            'seo' => [
                'title' => __('My Reviews'),
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
    public function create(string $lang, Property $property): Response | RedirectResponse
    {
        // dd($property);
        if ($property->is_reviewed) {
            session()->flash('flash.banner', __("You have already reviewed") . ' ' . $property->title->$lang);
            session()->flash('flash.bannerStyle', 'danger');

            return redirect(route('properties.reviews.index', ['lang' => $lang, 'property' => $property]));
        }

        Gate::authorize('create', Review::class);

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
