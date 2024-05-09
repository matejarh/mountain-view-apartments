<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewPages;
use App\Contracts\DeletesPages;
use App\Contracts\PageCreateResponse;
use App\Contracts\PageDeleteResponse;
use App\Contracts\PageUpdateResponse;
use App\Contracts\UpdatesPages;
use App\Filters\PageFilters;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PagesController extends Controller
{
    /**
     * Get filtered ordered paginated pages collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\PageFilters $filters The filters instance.
     * @return \Inertia\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, PageFilters $filters): Response
    {
        if (auth()->user()->cannot('viewAny', Page::class))
            abort(403);

        return Inertia::render('Admin/Pages/Index', [
            'pages' => Page::filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_pages' => auth()->user()->can('viewAny', Page::class),
            ],

        ]);
    }

    /**
     * Creates new page with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewPages  $creator
     * @return \App\Contracts\PageCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, CreatesNewPages $creator): PageCreateResponse
    {
        if ($request->user()->cannot('create', Page::class))
            abort(403);

        $creator->create($request->all());

        return app(PageCreateResponse::class);
    }

    /**
     * Updates given page with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @param  \App\Contracts\UpdatesPages  $updater
     * @return \App\Contracts\PageUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Page $page, UpdatesPages $updater): PageUpdateResponse
    {
        if ($request->user()->cannot('update', $page))
            abort(403);

        $updater->update($page, $request->all());

        return app(PageUpdateResponse::class);
    }

    /**
     * Destroyes given page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @param  \App\Contracts\DeletesPages  $updater
     * @return \App\Contracts\PageDeleteResponse
     */
    public function destroy(Request $request, Page $page, DeletesPages $destroyer): PageDeleteResponse
    {
        if ($request->user()->cannot('update', $page))
            abort(403);

        $destroyer->destroy($page);

        return app(PageDeleteResponse::class);
    }
}
