<?php

namespace App\Actions\Reservations;

use App\Models\Reservation;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Contracts\ConfirmsReservations;


class ConfirmReservation implements ConfirmsReservations
{
    /**
     * Confirmes given reservation
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function confirm(Reservation $reservation): void
    {
        $reservation->confirm();

        session()->flash('flash.banner', __('Reservation has been confirm.'));
    }
}
