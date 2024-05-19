<?php

namespace App\Http\Responses;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use App\Contracts\PropertyReviewResponse as PropertyReviewResponseContract;

class PropertyReviewedResponse implements PropertyReviewResponseContract
{
    /**
     * The response status language key.
     *
     * \App\Models\Property
     */
    protected $property;

    /**
     * Create a new response instance.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function __construct(Property $property)
    {
        $this->property = $property;
    }
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $locale = app()->currentLocale();

        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect(route('reviews.index', [
                'property' => $this->property,
                'lang' => app()->currentLocale()
            ]))->with('status', 'property-reviewed');
    }
}
