<?php

namespace App\Http\Controllers\Admin;

use App\Filters\ActivityFilters;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ActivitiesLogController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\ActivityFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, ActivityFilters $filters) : Response {

        Gate::authorize('viewAny', Activity::class);

        return Inertia::render('Admin/Activity/Index', [
            'activities' => Activity::adminFeed($request, $filters),
            'types' => Activity::get()->groupBy('type')->keys(),
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
