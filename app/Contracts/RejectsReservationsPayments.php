<?php

namespace App\Contracts;
use App\Models\Reservation;

interface RejectsReservationsPayments
{
    /**
     * Rejects payment for given reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function reject(Reservation $reservation);
}
