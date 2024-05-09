<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
            'data' => Page::where('name', 'Home')->first(),
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }
}
