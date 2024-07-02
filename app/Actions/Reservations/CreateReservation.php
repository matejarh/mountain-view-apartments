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
use Illuminate\Support\Carbon;
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
        $attributeNames = [

            'guests' => __('Guests'),
            'message' => __('Message'),
            'arrival' => __('Arrival'),
            'departure' => __('Departure'),
        ];



        $input['date_range'] = $this->parseDates($input['date']);

        $input['arrival'] = $input['date_range'][0];
        $input['departure'] = $input['date_range'][1];

        //dd($input['date_range']);
        $validator = Validator::make($input, [

            'message' => ['nullable', 'string', 'min:10', 'max:1000', new SpamFree],
            'guests' => ['required', 'array', 'min:1'],
            'guests.adults' => ['required', 'min:1', 'integer', 'max:10'],
            'guests.kids' => ['nullable', 'min:1', 'integer', 'max:10'],
            'guests.pets' => ['boolean'],
            'arrival' => ['required', 'date', 'before:departure', new AllowedBookingRange],
            'departure' => ['required', 'date', 'after:arrival', new AllowedBookingRange],
            'date_range' => [new DateRangeOverlap($property->id)],
            'captcha_token' => [new Recaptcha],

        ], [
            'arrival.required' => __('Arrival date is required.'),
            'arrival.date' => __('Arrival date must be a valid date.'),
            'arrival.before' => __('Arrival date must be before the departure date.'),
            'departure.required' => __('Departure date is required.'),
            'departure.date' => __('Departure date must be a valid date.'),
            'departure.after' => __('Departure date must be after the arrival date.'),
        ]);


        $validator->setAttributeNames($attributeNames)->validate();

        $reservation = $property->reservations()->forceCreate([
            'user_id' => auth()->id(),
            'arrival' => $input['arrival'],
            'departure' => $input['departure'],
            'guests' => $input['guests'],
            'message' => $input['message'],
            'price' => session()->get('price'),
            'nights' => session()->get('nights'),
        ]);

        session()->forget(['price', 'nights']);

        try {
            Notification::send(User::adminsMailingList(), new ReservationReceived($reservation->fresh()));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        session()->flash('flash.banner', __('Reservation has been submitted for approval.'));
    }

    /**
     * Parse the date strings into Carbon instances.
     *
     * @param array $date Array containing arrival and departure dates
     * @return array Array containing Carbon instances for arrival and departure
     */
    private function parseDates(array $date): array
    {
        $locale = app()->getLocale();

        $arrival = Carbon::parseFromLocale($date[0], $locale)->setTime(16, 0);
        $departure = Carbon::parseFromLocale($date[1], $locale)->setTime(12, 0);

        return [$arrival, $departure];
    }
}
