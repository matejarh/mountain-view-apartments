<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Contracts\ImageDetacheResponse as ImageDetacheResponseContract;

class ImageDetachedResponse implements ImageDetacheResponseContract
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
            : back()->with('status', 'image-detached');
    }
}
