<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use App\Contracts\TranslationsUpdateResponse as TranslationsUpdateResponseContract;

class TranslationsUpdatedResponse implements TranslationsUpdateResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        // session()->flash('flash.banner', __('Translations updated successfully!'));
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : back()->with('status', 'translations-updated');
    }
}
