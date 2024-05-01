<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Contracts\GalleryDetacheResponse as GalleryDetacheResponseContract;

class GalleryDetachedResponse implements GalleryDetacheResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : back()->with('status', 'gallery-detached');
    }
}
