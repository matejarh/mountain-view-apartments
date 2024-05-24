<?php

namespace App\Contracts;
use App\Models\Reservation;

interface UpdatesReservations
{
    /**
     * Updates given reservation.
     *
     * @param  array $input
     * @param  \App\Models\Reservation $reservation
     */
    public function update(Reservation $reservation, array $input);
}
