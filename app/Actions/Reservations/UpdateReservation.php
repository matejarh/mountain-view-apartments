<?php

namespace App\Actions\Reservations;

use App\Contracts\UpdatesReservations;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\Admin\InquiryReceivedNotification;
use App\Notifications\Admin\ReservationReceived;
use App\Rules\AllowedBookingRange;
use App\Rules\DateRangeOverlap;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;



class UpdateReservation implements UpdatesReservations
{
    /**
     * Validate and updates given reservation.
     *
     * @param  array<string, string>  $input
     */
    public function update(Reservation $reservation, array $input)
    {
        $attributeNames = array(
            'guests' => __('Guests'),
            'message' => __('Message'),
            'date' => __('Date'),
        );

        $arrival = isset($input['arrival']) ? $input['arrival']->format('Y-m-d') . ' 16:00:00' : $reservation->arrival;
        $departure = isset($input['departure']) ? $input['departure']->format('Y-m-d') . ' 12:00:00' : $reservation->departure;
        $propertyId = $reservation->property_id;

        $input['date_range'] = [$arrival, $departure];

        $validator = Validator::make($input, [

            'message' => ['string', 'min:10', 'max:1000', new SpamFree],
            'guests' => ['array', 'min:1'],
            'guests.adults' => ['min:1', 'integer', 'max:10'],
            'guests.kids' => ['min:1', 'integer', 'max:10'],
            'guests.pets' => ['boolean'],
            'arrival' => ['date', 'before:departure', new AllowedBookingRange],
            'departure' => ['date', 'after:arrival', new AllowedBookingRange],
            'date_range' => [new DateRangeOverlap($propertyId, $reservation->id)],
            'captcha_token' => [new Recaptcha],
        ]);

        //dd($validator);

        $validator->setAttributeNames($attributeNames)->validate();

        $reservation = $reservation->forceFill([
            'arrival' => isset($input['arrival']) ? $input['arrival'] : $reservation->arrival,
            'departure' => isset($input['arrival']) ? $input['departure'] : $reservation->departure,
            'guests' => isset($input['arrival']) ? $input['guests'] : $reservation->guests,
            'message' => isset($input['arrival']) ? $input['message'] : $reservation->message,
        ])->save();

        //dd($inquiry);

        //Notification::send(User::adminsMailingList(), new ReservationReceived($reservation->fresh()));

        session()->flash('flash.banner', __('Reservation has been updated.'));
    }
}
