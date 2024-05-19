<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Property;
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
        return Inertia::render('Welcome', [
            'page' => Page::with('galleries')->where('name', 'Home')->first(),
            'accomodations' => Property::with('galleries', 'reviews')->get(),
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
}
