<?php

namespace App\Contracts;
use App\Models\Reservation;

interface ConfirmsReservations
{
    /**
     * Rejects payment for given reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function confirm(Reservation $reservation);
}
