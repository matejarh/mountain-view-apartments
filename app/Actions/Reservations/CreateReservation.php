<?php

namespace App\Actions\Reservations;

use App\Contracts\CreatesReservations;
use App\Models\Property;
use App\Models\User;
use App\Notifications\Admin\InquiryReceivedNotification;
use App\Notifications\Admin\ReservationReceived;
use App\Rules\AllowedBookingRange;
use App\Rules\DateRangeOverlap;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;



class CreateReservation implements CreatesReservations
{
    /**
     * Validate and create new reservation for given property for auth user.
     *
     * @param  array<string, string>  $input
     */
    public function create(Property $property, array $input)
    {
        $attributeNames = array(
            'guests' => __('Guests'),
            'message' => __('Message'),
            'arrival' => __('Arrival'),
            'departure' => __('Departure'),
        );

        $arrival = $input['arrival']->format('Y-m-d') . ' 16:00:00';
        $departure = $input['departure']->format('Y-m-d') . ' 12:00:00';
        $propertyId = $property->id;

        $input['date_range'] = [$arrival,$departure];

        //dd($input['date_range']);
        $validator = Validator::make($input, [

            'message' => ['required', 'string', 'min:10', 'max:1000', new SpamFree],
            'guests' => ['required', 'array', 'min:1'],
            'guests.adults' => ['required', 'min:1', 'integer', 'max:10'],
            'guests.kids' => ['nullable', 'min:1', 'integer', 'max:10'],
            'guests.pets' => ['boolean'],
            'arrival' => ['required', 'date', 'before:departure', new AllowedBookingRange],
            'departure' => ['required', 'date', 'after:arrival', new AllowedBookingRange],
            'date_range' => [new DateRangeOverlap($propertyId)],
            'captcha_token' => [new Recaptcha],

        ], [
            'arrival.required' => 'Arrival date is required.',
            'arrival.date' => 'Arrival date must be a valid date.',
            'arrival.before' => 'Arrival date must be before the departure date.',
            'departure.required' => 'Departure date is required.',
            'departure.date' => 'Departure date must be a valid date.',
            'departure.after' => 'Departure date must be after the arrival date.',
        ]);

        //dd($validator);

        $validator->setAttributeNames($attributeNames)->validate();


            // $input['arrival'] = \Carbon\Carbon::parse($input['arrival'])->format('Y-m-d');


        $reservation = $property->reservations()->forceCreate([
            'user_id' => auth()->id(),
            'arrival' => $input['arrival'],
            'departure' => $input['departure'],
            'guests' => $input['guests'],
            'message' => $input['message'],
        ]);

        //dd($inquiry);

        Notification::send(User::adminsMailingList(), new ReservationReceived($reservation->fresh()));

        session()->flash('flash.banner', __('Reservation has been submitted for approval.'));
    }
}
