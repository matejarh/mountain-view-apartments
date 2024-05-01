<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewGalleries;
use App\Contracts\GalleryCreateResponse;
use App\Contracts\GalleryUpdateResponse;
use App\Contracts\UpdatesGalleries;
use App\Http\Controllers\Controller;
use App\Http\Responses\GalleryCreatedResponse;
use App\Http\Responses\GalleryUpdatedResponse;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GalleriesController extends Controller
{
    /**
     * Renders and returnes Galleries Index Page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function index(Request $request): Response
    {
        if (auth()->user()->cannot('viewAny', Gallery::class))
            abort(403);

        return Inertia::render('Admin/Galleries/Index', [
            'galleries' => Gallery::latest()->get(),
        ]);
    }

    /**
     * Creates new gallery with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewGalleries  $creator
     * @return \App\Contracts\GalleryCreateResponse
     */
    public function store(Request $request, CreatesNewGalleries $creator): GalleryCreatedResponse
    {
        if ($request->user()->cannot('create', Gallery::class))
            abort(403);

        $creator->create($request->all());

        return app(GalleryCreateResponse::class);
    }

    /**
     * Updates given gallery with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Contracts\UpdatesGalleries  $updater
     * @return \App\Contracts\GalleryUpdateResponse
     */
    public function update(Request $request, Gallery $gallery, UpdatesGalleries $updater): GalleryUpdatedResponse
    {
        if ($request->user()->cannot('update', $gallery))
            abort(403);

        $updater->update($gallery, $request->all());

        return app(GalleryUpdateResponse::class);
    }
}
