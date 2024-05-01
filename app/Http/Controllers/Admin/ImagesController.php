<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesNewImages;
use App\Contracts\ImageUpdateResponse;
use App\Contracts\UpdatesImages;
use App\Http\Controllers\Controller;
use App\Http\Responses\ImageCreatedResponse;
use App\Http\Responses\ImageUpdatedResponse;
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
    public function store(Request $request, CreatesNewImages $creator): ImageCreatedResponse
    {
        if ($request->user()->cannot('create', Image::class))
            abort(403);

        $creator->create($request->all());

        return app(ImageCreatedResponse::class);
    }


    /**
     * Updates given image with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @param  \App\Contracts\UpdatesImages  $updater
     * @return \App\Contracts\ImageUpdateResponse
     */
    public function update(Request $request, Image $image, UpdatesImages $updater): ImageUpdatedResponse
    {
        if ($request->user()->cannot('update', $image))
            abort(403);

        $updater->update($image, $request->all());

        return app(ImageUpdatedResponse::class);
    }
}
