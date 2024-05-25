<?php

namespace App\Actions\Reservations;

use App\Models\Reservation;
use App\Contracts\RejectsReservationsPayments;


class RejectPayment implements RejectsReservationsPayments
{
    /**
     * Rejects payment for given reservation
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function reject(Reservation $reservation): void
    {
        $reservation->rejectPayment();

        session()->flash('flash.banner', __('Payment for reservation has been rejected.'));
    }
}
