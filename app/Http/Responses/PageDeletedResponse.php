<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Contracts\PageDeleteResponse as PageDeleteResponseContract;

class PageDeletedResponse implements PageDeleteResponseContract
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
            : redirect(route('admin.pages.index'))->with('status', 'page-destroyed');
    }
}
