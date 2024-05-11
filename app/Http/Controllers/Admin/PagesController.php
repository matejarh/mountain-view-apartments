<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesGalleriesToPages;
use App\Contracts\CreatesNewPages;
use App\Contracts\DeletesPages;
use App\Contracts\DetachesGalleriesFromPages;
use App\Contracts\GalleryAttacheResponse;
use App\Contracts\GalleryDetacheResponse;
use App\Contracts\PageCreateResponse;
use App\Contracts\PageDeleteResponse;
use App\Contracts\PageUpdateResponse;
use App\Contracts\UpdatesPages;
use App\Filters\PageFilters;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
        Gate::authorize('viewAny', Page::class);

        return Inertia::render('Admin/Pages/Index', [
            'pages' => Page::with('galleries')->filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_pages' => auth()->user()->can('viewAny', Page::class),
            ],

        ]);
    }

    /**
     * Display the specified page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, Page $page): Response
    {
        // Check if the user has permission to view the page
        Gate::authorize('view', $page);

        // Render the page details page using Inertia.js
        return Inertia::render('Admin/Pages/Show', [
            // Pass the page details along with its galleries and facilities
            'page' => Page::with('galleries')->find($page->id),

            // Retrieve galleries not currently associated with the page, including their images
            'galleries_not_in_page' => Gallery::with('images')->get()->intersect(
                Gallery::whereNotIn('id', $page->galleries->pluck('id')->toArray())->get()
            ),

            // Determine the user's permissions for this page
            'can' => [
                'view_page' => auth()->user()->can('view', $page),
                'edit_page' => auth()->user()->can('update', $page),
                'delete_page' => auth()->user()->can('delete', $page),
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
        Gate::authorize('create', Page::class);

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
        Gate::authorize('update', $page);

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Page $page, DeletesPages $destroyer): PageDeleteResponse
    {
        Gate::authorize('update', $page);

        $destroyer->destroy($page);

        return app(PageDeleteResponse::class);
    }

    /**
     * Attaches given gallery to given page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Page $page
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Contracts\AttachesGalleriesToPages $attacher
     * @return \App\Contracts\GalleryAttacheResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function attachGallery(Request $request, Page $page, Gallery $gallery, AttachesGalleriesToPages $attacher): GalleryAttacheResponse
    {
        Gate::authorize('update', $page);

        $attacher->attach($gallery, $page);

        return app(GalleryAttacheResponse::class);
    }

    /**
     * Detaches given gallery grom given page.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Page $page
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Contracts\DetachesGalleriesFromPages $attacher
     * @return \App\Contracts\GalleryDetacheResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function detachGallery(Request $request, Page $page, Gallery $gallery, DetachesGalleriesFromPages $attacher): GalleryDetacheResponse
    {
        Gate::authorize('update', $page);

        $attacher->detach($gallery, $page);

        return app(GalleryDetacheResponse::class);
    }
}
