<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ActivityFilters;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActivitiesLogController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Filters\ActivityFilters $filters
     * @return \Inertia\Response
     */
    public function index(Request $request, ActivityFilters $filters ) : Response {

        if (auth()->user()->cannot('viewAny', Activity::class)) abort(403);

        return Inertia::render('Admin/Activity/Index', [
            'activities' => Activity::adminFeed($request, $filters),
            'filters' => $request->only(['search', 'sortBy', 'sortDirection']),

        ]);
    }

    public function feed( $skip = 0) : JsonResponse {
        return response()->json([
            'activities' => Activity::adminFeed(200, $skip),
            'total' => \DB::table('activities')->count(),
            'range' => [
                'take' => 200,
                'skip' => $skip + 200
,            ]
        ]);
    }
}
