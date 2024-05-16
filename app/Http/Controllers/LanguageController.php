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

        $language = $request->input('language');

        session()->put(['language' => $language, 'locale' => $language]);

        return redirect()->back()/* ->withCookie(cookie()->forever('language', $language)) */;
    }
}
