<?php

namespace App\Http\Responses;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use App\Contracts\ReservationCreateResponse as ReservationCreateResponseContract;

class ReservationCreatedResponse implements ReservationCreateResponseContract
{
    public $input;
    public $property;

    public function __construct(array $input, Property $property) {
        $this->input = $input;
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
        return $request->wantsJson()
            ? new JsonResponse('', 201)
            : redirect(route('reservations.index', app()->currentLocale()))->with('status', 'reservation-created')->with('input', $this->input);
    }
}
