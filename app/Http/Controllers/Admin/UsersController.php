<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    public function index(Request $request ) : Response {
        // session()->flash('flash.banner', __('Welcome!'));
        // session()->flash('flash.bannerStyle', 'success');

        if ($request->user()->cannot('viewAny', User::class)) abort(403);

        $sortBy = $request->has('sortBy') ? trim($request->sortBy) : 'name';
        $sortDirection = $request->has('sortDirection') ? trim($request->sortDirection) : 'asc';

        $users = User::orderBy($sortBy, $sortDirection)->filter($request->only(['search']))->paginate(10)->onEachSide(2)->withQueryString();

        return Inertia::render('Admin/Users', [
            'users' => $users,
            'filters' => $request->only(['search', 'sortBy', 'sortDirection']),
            /* 'links' => $users->withQueryString()->links('vendor.pagination.tailwind-table', [
                'onEachSide' => 2,
            ])->toHtml(), */

        ]);
    }
}
