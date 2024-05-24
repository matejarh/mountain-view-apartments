<?php

namespace App\Contracts;
use App\Models\Reservation;

interface DeletesReservations
{
    /**
     * Deletes given $reservation.
     *
     * @param  \App\Models\Reservation $reservation
     */
    public function destroy(Reservation $reservation);
}
