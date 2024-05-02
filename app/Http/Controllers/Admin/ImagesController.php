<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesImagesToGalleries;
use App\Contracts\CreatesNewImages;
use App\Contracts\DeletesImages;
use App\Contracts\DetachesGalleriesFromImages;
use App\Contracts\DetachesImagesFromGalleries;
use App\Contracts\ImageAttacheResponse;
use App\Contracts\ImageCreateResponse;
use App\Contracts\ImageDeleteResponse;
use App\Contracts\ImageDetacheResponse;
use App\Contracts\ImageUpdateResponse;
use App\Contracts\UpdatesImages;
use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Creates new image with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesNewImages  $creator
     * @return \App\Contracts\ImageCreateResponse
     */
    public function store(Request $request, CreatesNewImages $creator): ImageCreateResponse
    {
        if ($request->user()->cannot('create', Image::class))
            abort(403);

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
     */
    public function update(Request $request, Image $image, UpdatesImages $updater): ImageUpdateResponse
    {
        if ($request->user()->cannot('update', $image))
            abort(403);

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
     */
    public function destroy(Request $request, Image $image, DeletesImages $destroyer): ImageDeleteResponse
    {
        if ($request->user()->cannot('update', $image))
            abort(403);

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
     */
    public function attach(Request $request, Image $image, Gallery $gallery, AttachesGalleriesToImages $attacher): ImageAttacheResponse
    {
        if ($request->user()->cannot('update', $image))
            abort(403);

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
     */
    public function detach(Request $request, Image $image, Gallery $gallery, DetachesGalleriesFromImages $attacher): ImageDetacheResponse
    {
        if ($request->user()->cannot('update', $image))
            abort(403);

        $attacher->detach($gallery, $image);

        return app(ImageDetacheResponse::class);
    }
}
