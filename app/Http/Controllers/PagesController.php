<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Property;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class PagesController extends Controller
{
    /**
     * Get home page data
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @return \Inertia\Response
     */
    public function home(Request $request ) :Response
    {
        $bled = Page::with('galleries')->where('name', 'Explore Bled')->first();
        $nassfeld = Page::with('galleries')->where('name', 'Discover Nassfeld')->first();
        $discover = [
            'bled' => [
                'title' => $bled->title,
                'description' => $bled->description,
                'link' => '/' . app()->currentLocale() . '/explore/bled',
                'images' => $bled->galleries->count() > 0 ? $bled->galleries[0]->images : []
            ],
            'nassfeld' => [
                'title' => $nassfeld->title,
                'description' => $nassfeld->description,
                'link' => '/' . app()->currentLocale() . '/discover/nassfeld',
                'images' => $nassfeld->galleries->count() > 0 ? $nassfeld->galleries[0]->images : []
            ],
        ];

        $reviews = Review::with('reviewed')->orderByDesc('score')->take(10)->get();

        return Inertia::render('Welcome', [
            'page' => Page::with('galleries')->where('name', 'Home')->first(),
            'accomodations' => Property::with('galleries', 'reviews')->get(),
            'discover' => $discover,
            'reviews' => $reviews,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function aboutUs(Request $request ) :Response
    {
        return Inertia::render('AboutUs', [
            'page' => Page::with('galleries')->where('name', 'About Us')->first(),
            // 'accomodations' => Property::with('galleries')->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function bled(Request $request ) :Response
    {
        // dd(Page::with('galleries')->where('name', 'Explore Bled')->first());
        return Inertia::render('Page', [
            'page' => Page::with('galleries')->where('name', 'Explore Bled')->first(),
            'properties' => Property::with('galleries')->where('address', 'LIKE', '%bled%')->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    public function nassfeld(Request $request ) :Response
    {
        // dd(Page::with('galleries')->where('name', 'Discover Nassfeld')->first());
        return Inertia::render('Page', [
            'page' => Page::with('galleries')->where('name', 'Discover Nassfeld')->first(),
            'properties' => Property::with('galleries')->where('address', 'LIKE', '%hermagor%')->get(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
