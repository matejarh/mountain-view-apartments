<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesImagesToGalleries;
use App\Contracts\CreatesNewGalleries;
use App\Contracts\DeletesGalleries;
use App\Contracts\DetachesGalleriesFromImages;
use App\Contracts\DetachesImagesFromGalleries;
use App\Contracts\GalleryAttacheResponse;
use App\Contracts\GalleryCreateResponse;
use App\Contracts\GalleryDeleteResponse;
use App\Contracts\GalleryDetacheResponse;
use App\Contracts\GalleryUpdateResponse;
use App\Contracts\UpdatesGalleries;
use App\Filters\GalleryFilters;
use App\Http\Controllers\Controller;
use App\Http\Responses\GalleryCreatedResponse;
use App\Http\Responses\GalleryUpdatedResponse;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GalleriesController extends Controller
{
    /**
     * Renders and returnes Galleries Index Page.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\GalleryFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, GalleryFilters $filters): Response
    {
        if (auth()->user()->cannot('viewAny', Gallery::class))
            abort(403);

        return Inertia::render('Admin/Galleries/Index', [
            'galleries' => Gallery::with('images')->filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_gallery' => auth()->user()->can('viewAny', Gallery::class),
            ],

        ]);
    }

    /**
     * Renders and returns given gallery page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Inertia\Response
     */
    public function show(Request $request, Gallery $gallery): Response
    {
        if (auth()->user()->cannot('view', $gallery))
            abort(403);

        return Inertia::render('Admin/Galleries/Show', [
            'gallery' => Gallery::with('images')->find($gallery->id),
            'images_not_in_gallery' => Image::all()->intersect(Image::whereNotIn('id', $gallery->images->pluck('id')->toArray())->get())
                                        ->paginate(20, null,null, __('page'))->onEachSide(2)->withQueryString(),
            'total_images_count' => \DB::table('images')->count(),
            'can' => [
                'view_gallery' => auth()->user()->can('view', $gallery),
                'delete_images' => auth()->user()->can('delete', Image::class),
            ],
        ]);
    }

    /**
     * Creates new gallery with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewGalleries  $creator
     * @return \App\Contracts\GalleryCreateResponse
     */
    public function store(Request $request, CreatesNewGalleries $creator): GalleryCreateResponse
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
    public function update(Request $request, Gallery $gallery, UpdatesGalleries $updater): GalleryUpdateResponse
    {
        if ($request->user()->cannot('update', $gallery))
            abort(403);

        $updater->update($gallery, $request->all());

        return app(GalleryUpdateResponse::class);
    }


    /**
     * Destroyes given gallery.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Contracts\DeletesGalleries $destroyer
     * @return \App\Contracts\GalleryDeleteResponse
     */
    public function destroy(Request $request, Gallery $gallery, DeletesGalleries $destroyer): GalleryDeleteResponse
    {
        if ($request->user()->cannot('update', $gallery))
            abort(403);

        $destroyer->destroy($gallery);

        return app(GalleryDeleteResponse::class);
    }

    /**
     * Attaches given gallery to given image.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Image $image
     * @param  \App\Contracts\AttachesImagesToGalleries $attacher
     * @return \App\Contracts\ImageAttacheResponse
     */
    public function attach(Request $request, Gallery $gallery, Image $image, AttachesImagesToGalleries $attacher): GalleryAttacheResponse
    {
        if ($request->user()->cannot('update', $gallery))
            abort(403);

        $attacher->attach($image, $gallery);

        return app(GalleryAttacheResponse::class);
    }

    /**
     * Detaches given gallery grom given image.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Gallery $gallery
     * @param  \App\Models\Image $image
     * @param  \App\Contracts\DetachesImagesFromGalleries $attacher
     * @return \App\Contracts\GalleryDetacheResponse
     */
    public function detach(Request $request, Gallery $gallery, Image $image, DetachesImagesFromGalleries $attacher): GalleryDetacheResponse
    {
        if ($request->user()->cannot('update', $gallery))
            abort(403);

        $attacher->detach($image, $gallery);

        return app(GalleryDetacheResponse::class);
    }
}
