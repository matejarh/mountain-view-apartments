<?php

namespace App\Actions\Reservations;

use App\Models\Reservation;
use App\Contracts\RejectsReservations;


class RejectReservation implements RejectsReservations
{
    /**
     * Rejects given reservation
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function reject(Reservation $reservation): void
    {
        $reservation->reject();

        session()->flash('flash.banner', __('Reservation has been rejected.'));
    }
}
