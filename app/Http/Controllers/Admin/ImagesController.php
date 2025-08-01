<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\CreatesNewImages;
use App\Contracts\DeletesImages;
use App\Contracts\DetachesGalleriesFromImages;
use App\Contracts\ImageAttacheResponse;
use App\Contracts\ImageCreateResponse;
use App\Contracts\ImageDeleteResponse;
use App\Contracts\ImageDetacheResponse;
use App\Contracts\ImageUpdateResponse;
use App\Contracts\UpdatesImages;
use App\Filters\ImageFilters;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ImagesController extends Controller
{
    /**
     * Get filtered ordered paginated images collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\ImageFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, ImageFilters $filters): Response
    {
        Gate::authorize('viewAny', Image::class);

        return Inertia::render('Admin/Images/Index', [
            'images' => Image::with('galleries')->filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search']),
            'can' => [
                'view_images' => auth()->user()->can('viewAny', Image::class),
            ],

        ]);
    }

    /**
     * Creates new image with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewImages  $creator
     * @return \App\Contracts\ImageCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, CreatesNewImages $creator): ImageCreateResponse
    {
        Gate::authorize('create', Image::class);

        $creator->create($request->all());

        return app(ImageCreateResponse::class);
    }


    /**
     * Updates given image with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @param  \App\Contracts\UpdatesImages  $updater
     * @return \App\Contracts\ImageUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Image $image, UpdatesImages $updater): ImageUpdateResponse
    {
        Gate::authorize('update', $image);

        $updater->update($image, $request->all());

        return app(ImageUpdateResponse::class);
    }

    /**
     * Destroyes given image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @param  \App\Contracts\DeletesImages  $updater
     * @return \App\Contracts\ImageDeleteResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Image $image, DeletesImages $destroyer): ImageDeleteResponse
    {
        Gate::authorize('update', $image);

        $destroyer->destroy($image);

        return app(ImageDeleteResponse::class);
    }

    /**
     * Attaches given image to given gallery.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Contracts\AttachesGalleriesToImages  $attacher
     * @return \App\Contracts\ImageAttacheResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function attach(Request $request, Image $image, Gallery $gallery, AttachesGalleriesToImages $attacher): ImageAttacheResponse
    {
        Gate::authorize('update', $image);

        $attacher->attach($gallery, $image);

        return app(ImageAttacheResponse::class);
    }

    /**
     * Detaches given image from given gallery.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @param  \App\Models\Gallery  $gallery
     * @param  \App\Contracts\DetachesGalleriesFromImages  $attacher
     * @return \App\Contracts\ImageDetacheResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function detach(Request $request, Image $image, Gallery $gallery, DetachesGalleriesFromImages $attacher): ImageDetacheResponse
    {
        Gate::authorize('update', $image);

        $attacher->detach($gallery, $image);

        return app(ImageDetacheResponse::class);
    }

    /**
     * Fetches list of images not attached to given gallery
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request, Gallery $gallery) : JsonResponse
    {
        $images = Image::all()->intersect(Image::whereNotIn('id', $gallery->images->pluck('id')->toArray())->get())
                        ->paginate(20, null,null, __('page'))->onEachSide(2)->withQueryString();
        return response()->json([
            'images' => $images,
            'total_count' => \DB::table('images')->count(),
        ]);
    }

    /**
     * Fetches list of images not in current backgroud
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchBackgrounds(Request $request) : JsonResponse
    {
        $path = str(parse_url($request->only('attribute')['attribute'])['path'])->replace('/storage/', '');

        $images = Image::where('image_path', '!=', $path)->paginate(20)->onEachSide(2)->withQueryString();

        return response()->json([
            'images' => $images,
        ]);
    }
}
