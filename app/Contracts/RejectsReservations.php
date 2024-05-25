<?php

namespace App\Contracts;
use App\Models\Reservation;

interface RejectsReservations
{
    /**
     * Rejects payment for given reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function reject(Reservation $reservation);
}
