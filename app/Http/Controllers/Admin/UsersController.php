<?php

namespace App\Http\Controllers\Admin;

use App\Filters\UserFilters;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse;
use Laravel\Fortify\Fortify;

class UsersController extends Controller
{

    /**
     * Get filtered ordered paginated users collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request
     * @param \App\Filters\UserFilters
     * @return \Inertia\Response
     */
    public function index(Request $request, UserFilters $filters): Response
    {
        Gate::authorize('viewAny', User::class);

        $sortBy = $request->has('sortBy') ? trim($request->sortBy) : 'created_at';
        $sortDirection = $request->has('sortDirection') ? trim($request->sortDirection) : 'desc';

        $users = User::orderBy($sortBy, $sortDirection)->filter($filters)->paginate(12, ['*'], __('page'))->onEachSide(2)->withQueryString();

        return Inertia::render('Admin/Users', [
            'users' => $users,
            'filters' => $request->only(['search', 'sortBy', 'sortDirection']),
            /* 'links' => $users->withQueryString()->links('vendor.pagination.tailwind-table', [
                'onEachSide' => 2,
            ])->toHtml(), */ // Paginator moved to vue component due to SPA pages loading

        ]);
    }

    /**
     * Update the given user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return \Laravel\Fortify\Contracts\ProfileInformationUpdatedResponse
     */
    public function update(
        Request $request,
        User $user,
        UpdatesUserProfileInformation $updater
    ) {
        if ($request->user()->cannot('update', $user))
            abort(403);

        $updater->update($user, $request->all());

        return app(ProfileInformationUpdatedResponse::class);
    }
}
