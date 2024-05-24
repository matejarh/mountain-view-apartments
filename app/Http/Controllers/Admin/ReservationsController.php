<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesReservations;
use App\Contracts\DeletesReservations;
use App\Contracts\ReservationCreateResponse;
use App\Contracts\ReservationDeleteResponse;
use App\Contracts\ReservationUpdateResponse;
use App\Contracts\UpdatesReservations;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReservationsController extends Controller
{
    /**
     * Creates new reservation for given property with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contracts\CreatesReservations  $creator
     * @return \App\Contracts\ReservationCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Property $property, CreatesReservations $creator): ReservationCreateResponse
    {
        Gate::authorize('create', Reservation::class);

        $creator->create($property, $request->all());

        return app(ReservationCreateResponse::class);
    }

    /**
     * Updates given reservation with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\UpdatesReservations  $updater
     * @return \App\Contracts\ReservationUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Reservation $reservation, UpdatesReservations $updater): ReservationUpdateResponse
    {
        Gate::authorize('update', $reservation);

        $updater->update($reservation, $request->all());

        return app(ReservationUpdateResponse::class);
    }

    /**
     * Destroyes given reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\DeletesReservations  $updater
     * @return \App\Contracts\ReservationDeleteResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Reservation $reservation, DeletesReservations $destroyer): ReservationDeleteResponse
    {
        Gate::authorize('delete', $reservation);

        $destroyer->destroy($reservation);

        return app(ReservationDeleteResponse::class);
    }
}
