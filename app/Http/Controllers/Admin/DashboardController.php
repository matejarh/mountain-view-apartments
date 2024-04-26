<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function show(Request $request ) : Response {
        // session()->flash('flash.banner', __('Welcome!'));
        // session()->flash('flash.bannerStyle', 'success');
        return Inertia::render('Admin/Dashboard');
    }
}
