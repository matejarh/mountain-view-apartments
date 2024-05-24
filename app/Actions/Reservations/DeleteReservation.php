<?php

namespace App\Actions\Reservations;

use App\Contracts\DeletesReservations;
use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use App\Notifications\Admin\InquiryReceivedNotification;
use App\Notifications\Admin\ReservationReceived;
use App\Rules\AllowedBookingRange;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;



class DeleteReservation implements DeletesReservations
{
    /**
     * Deletes given reservation.
     *
     * @param  array<string, string>  $input
     */
    public function destroy(Reservation $reservation)
    {


        $reservation->delete();

        session()->flash('flash.banner', __('Reservation has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
