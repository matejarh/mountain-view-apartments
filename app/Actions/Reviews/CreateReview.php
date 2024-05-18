<?php

namespace App\Actions\Reviews;

use App\Contracts\StoresGuestReview;
use App\Models\Review;
use App\Models\Property;
use App\Models\User;
use App\Notifications\ReviewReceivedNotification;
use App\Rules\AllowedBookingRange;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewReviews;


class CreateReview implements CreatesNewReviews
{
    /**
     * Validate and create new review.
     *
     * @param  array<string, string>  $input
     */
    public function create(Property $property, array $input)
    {

        $validator = Validator::make($input, [
            'score' => ['required', 'integer', 'max:5', 'min:1'] ,
            'text' => ['required', 'string', 'min:5', 'max:100', new SpamFree, 'unique:reviews'],
        ]);

        $validator->validateWithBag('creatingReview');

        $property->review($input['score'], $input['text']);

        $locale = app()->currentLocale();

        session()->flash('flash.banner', __('You have reviewed').' '.$property->title->$locale.'.');

    }
}
