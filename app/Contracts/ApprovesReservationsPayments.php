<?php

namespace App\Contracts;
use App\Models\Reservation;

interface ApprovesReservationsPayments
{
    /**
     * Approves payment for given reservation.
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function approve(Reservation $reservation);
}
