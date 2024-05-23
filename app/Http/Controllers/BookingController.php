<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'property_id' => 'required|string',
            'checkin' => 'required|date',
            'checkout' => 'required|date',
            'adults' => 'required|integer|min=1',
            'children' => 'nullable|integer|min=0',
        ]);

        try {
            $data = $this->bookingService->checkAvailability(
                $request->input('property_id'),
                $request->input('checkin'),
                $request->input('checkout'),
                $request->input('adults'),
                $request->input('children', 0)
            );

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
