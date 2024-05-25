<?php

namespace App\Actions\Reservations;

use App\Models\Reservation;
use App\Contracts\ApprovesReservationsPayments;


class ApprovePayment implements ApprovesReservationsPayments
{
    /**
     * Rejects payment for given reservation
     *
     * @param  \App\Models\Reservation  $reservation
     */
    public function approve(Reservation $reservation): void
    {
        $reservation->approvePayment();

        session()->flash('flash.banner', __('Payment for reservation has been approved.'));
    }
}
