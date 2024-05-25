<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ApprovesReservationsPayments;
use App\Contracts\ConfirmsReservations;
use App\Contracts\CreatesReservations;
use App\Contracts\DeletesReservations;
use App\Contracts\RejectsReservations;
use App\Contracts\RejectsReservationsPayments;
use App\Contracts\ReservationConfirmResponse;
use App\Contracts\ReservationCreateResponse;
use App\Contracts\ReservationDeleteResponse;
use App\Contracts\ReservationPaymentApproveResponse;
use App\Contracts\ReservationPaymentRejectResponse;
use App\Contracts\ReservationRejectResponse;
use App\Contracts\ReservationUpdateResponse;
use App\Contracts\UpdatesReservations;
use App\Filters\ReservationFilters;
use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ReservationsController extends Controller
{
    /**
     * Get filtered ordered paginated reservations collection
     * and renders Inertia response
     *
     * @param \Illuminate\Http\Request $request The HTTP request object.
     * @param \App\Filters\ReservationFilters $filters The filters instance.
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request, ReservationFilters $filters): Response
    {
        Gate::authorize('viewAny', Reservation::class);

        return Inertia::render('Admin/Reservations/Index', [
            'reservations' => Reservation::with('property', 'owner')->filter($filters)->latest()->paginate(24, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'filters' => $request->only(['search', 'confirmed', 'rejected', 'paymentReceived', 'paymentNotReceived']),
            'can' => [
                'view_reservations' => auth()->user()->can('viewAny', Reservation::class),
            ],

        ]);
    }

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

    /**
     * Confirmes given reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\ConfirmsReservations  $updater
     * @return \App\Contracts\ReservationConfirmResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function confirm(Request $request, Reservation $reservation, ConfirmsReservations $confirmer): ReservationConfirmResponse
    {
        Gate::authorize('update', $reservation);

        $confirmer->confirm($reservation);

        return app(ReservationConfirmResponse::class);
    }

    /**
     * Rejects given reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\RejectsReservations  $updater
     * @return \App\Contracts\ReservationRejectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function reject(Request $request, Reservation $reservation, RejectsReservations $confirmer): ReservationRejectResponse
    {
        Gate::authorize('update', $reservation);

        $confirmer->reject($reservation);

        return app(ReservationRejectResponse::class);
    }

    /**
     * Rejects payment for given reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\RejectsReservationsPayments  $confirmer
     * @return \App\Contracts\ReservationPaymentRejectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function rejectPayment(Request $request, Reservation $reservation, RejectsReservationsPayments $confirmer): ReservationPaymentRejectResponse
    {
        Gate::authorize('update', $reservation);

        $confirmer->reject($reservation);

        return app(ReservationPaymentRejectResponse::class);
    }

    /**
     * Approves payment for given reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @param  \App\Contracts\ApprovesReservationsPayments  $confirmer
     * @return \App\Contracts\ReservationPaymentApproveResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function approvePayment(Request $request, Reservation $reservation, ApprovesReservationsPayments $confirmer): ReservationPaymentApproveResponse
    {
        Gate::authorize('update', $reservation);

        $confirmer->approve($reservation);

        return app(ReservationPaymentApproveResponse::class);
    }
}
