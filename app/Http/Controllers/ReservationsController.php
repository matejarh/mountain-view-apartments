<?php

namespace App\Http\Controllers;

use App\Contracts\CreatesReservations;
use App\Contracts\ReservationCreateResponse;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ReservationsController extends Controller
{
    public function index(Request $request) :Response
    {
        return Inertia::render('MyReservations/Index', [
            'reservations' => auth()->user()->reservations->paginate(20, null,null, __('page'))->onEachSide(2)->withQueryString(),
            'seo' => [
                'title' => __('My Reservations'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }


    public function store(Request $request, Property $property, CreatesReservations $creator ) :ReservationCreateResponse
    {

        Gate::authorize('create', Reservation::class);

        $creator->create($property, $request->all());

        return app(ReservationCreateResponse::class);
    }
}
