<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ActivitiesController extends Controller
{
    public function index(Request $request) :JsonResponse  {
        return response()->json(Activity::feed(auth()->user()));
    }

}
