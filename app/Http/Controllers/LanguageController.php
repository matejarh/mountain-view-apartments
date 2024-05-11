<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class LanguageController extends Controller
{
    public function switch(Request $request) : Redirector|RedirectResponse {

        //Route::currentRouteName();

        //dd($request->route()->getAction());
        $language = $request->input('language');

        session(['language' => $language, 'locale' => $language]);

        return redirect()->back()->withCookie(cookie()->forever('language', $language));
    }
}
