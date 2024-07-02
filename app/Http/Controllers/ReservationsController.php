<?php

namespace App\Http\Controllers;

use App\Contracts\CreatesReservations;
use App\Contracts\ReservationCreateResponse;
use App\Models\Price;
use App\Models\Property;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ReservationsController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('MyReservations/Index', [
            'reservations' => auth()->user()->reservations()->with('property')->paginate(20, ['*'], __('page'))->onEachSide(2)->withQueryString(),
            'seo' => [
                'title' => __('My Reservations'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }

    public function create(Request $request): Response
    {
        $propertySlug = $request->get('property') ?? null;
        $date = $request->get('date') ?? null;

        $property = Property::where('slug', $propertySlug)->first();

        if ($property) {
            $property->append('unavailable_dates');
        }

        /* if ($property && $date) {
            $prices =
        } */

        return Inertia::render('MyReservations/Create', [
            'properties' => Property::fetchListForDropdowns(),
            'selected' => [
                'property' => $property,
                'date' => $date,
            ],
            'stripe_pub_key' => config('cashier.key'),
            'seo' => [
                'title' => __('Create New Reservation'),
                'description' => '',
                'keywords' => ''
            ]
        ]);
    }

    public function calculate(Request $request): JsonResponse
    {
        // Validate the request data
        $validated = $this->validateRequest($request);

        try {
            // Parse arrival and departure dates
            [$arrival, $departure] = $this->parseDates($validated['date']);

            // Calculate the number of days in the stay
            $days = round($arrival->diffInDays($departure), 0);

            // Find the property
            $property = Property::findOrFail($validated['propertyId']);

            // Fetch prices within the date range
            $prices = $this->getPricesForRange($property->id, $arrival, $departure);

            // Validate against min_days and max_days in the price records
            $this->validateDaysAgainstPriceRules($prices, $days);

            // Validate against min guests and max guests in the price records
            $this->validateGuestsAgainstPriceRules($prices, $validated['guests']['adults']);

            // Calculate total price
            $totalPrice = $this->calculateTotalPrice($prices, $arrival, $departure, $validated['guests']['adults']);

            session()->put(['price' => $totalPrice, 'nights' => (int) $days]);

            return response()->json(['price' => $totalPrice, 'nights' => (int) $days]);

        } catch (\Exception $e) {
            // Handle exceptions and return a meaningful error response
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Validate the incoming request.
     *
     * @param Request $request
     * @return array Validated data
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'date' => 'required|array|size:2',
            'date.0' => 'required|before:date.1',
            'date.1' => 'required|after:date.0',
            'propertyId' => 'required|integer|exists:properties,id',
            'guests' => 'required|array|size:3',
            'guests.adults' => 'required|integer|min:1',
            'guests.children' => 'required|integer|min:0',
            'guests.pets' => 'required|boolean',
        ]);
    }

    /**
     * Parse the date strings into Carbon instances.
     *
     * @param array $date Array containing arrival and departure dates
     * @return array Array containing Carbon instances for arrival and departure
     */
    private function parseDates(array $date): array
    {
        $locale = app()->getLocale();

        $arrival = Carbon::parseFromLocale($date[0], $locale)->setTime(16, 0);
        $departure = Carbon::parseFromLocale($date[1], $locale)->setTime(12, 0);

        return [$arrival, $departure];
    }

    /**
     * Get prices for a given property within the date range.
     *
     * @param int $propertyId The ID of the property.
     * @param Carbon $arrival The arrival date.
     * @param Carbon $departure The departure date.
     * @return \Illuminate\Database\Eloquent\Collection The collection of applicable Price records.
     */
    private function getPricesForRange(int $propertyId, Carbon $arrival, Carbon $departure)
    {
        return Price::query()
            ->where('property_id', $propertyId)
            ->where(function ($query) use ($arrival, $departure) {
                $query->whereBetween('from', [$arrival, $departure])
                    ->orWhereBetween('to', [$arrival, $departure])
                    ->orWhere(function ($query) use ($arrival, $departure) {
                        $query->where('from', '<=', $arrival)
                            ->where('to', '>=', $departure);
                    });
            })
            ->get();
    }

    /**
     * Validate the number of days against the min_days and max_days constraints of the price records.
     *
     * @param \Illuminate\Database\Eloquent\Collection $prices The collection of Price records.
     * @param int $days The number of days between arrival and departure.
     * @throws \Exception If the number of days is not within the valid range for any price.
     */
    private function validateDaysAgainstPriceRules($prices, int $days): void
    {
        foreach ($prices as $price) {
            if ($days < $price->min_days || $days > $price->max_days) {
                throw new \Exception("The stay duration must be between {$price->min_days} and {$price->max_days} days for the specified date range.");
            }
        }
    }

    /**
     * Validate the number of guests against the min guests and max guests constraints of the price records.
     *
     * @param \Illuminate\Database\Eloquent\Collection $prices The collection of Price records.
     * @param int $guests The number of guests.
     * @throws \Exception If the number of guests is not within the valid range for any price.
     */
    private function validateGuestsAgainstPriceRules($prices, int $guests): void
    {
        $minGuests = null;
        $maxGuests = null;

        foreach ($prices as $price) {
            foreach ($price->prices as $priceEntry) {
                if (isset($priceEntry['guests'])) {
                    $currentGuests = (int) $priceEntry['guests'];
                    if ($minGuests === null || $currentGuests < $minGuests) {
                        $minGuests = $currentGuests;
                    }
                    if ($maxGuests === null || $currentGuests > $maxGuests) {
                        $maxGuests = $currentGuests;
                    }
                }
            }
        }

        if ($guests < $minGuests || $guests > $maxGuests) {
            throw new \Exception("The number of guests must be between {$minGuests} and {$maxGuests} for the specified property.");
        }
    }

    /**
     * Calculate the total price for the given date range and number of guests.
     *
     * @param \Illuminate\Database\Eloquent\Collection $prices The collection of applicable Price records.
     * @param Carbon $arrival The arrival date.
     * @param Carbon $departure The departure date.
     * @param int $guests The number of guests.
     * @return float The total price.
     */
    private function calculateTotalPrice($prices, Carbon $arrival, Carbon $departure, int $guests): float
    {
        $totalPrice = 0.0;
        $currentDate = $arrival->copy();

        // Iterate over each day in the date range
        while ($currentDate->lte($departure)) {
            foreach ($prices as $price) {
                if ($currentDate->between($price->from, $price->to)) {
                    foreach ($price->prices as $priceEntry) {
                        // Check if the price entry matches the number of guests
                        if (isset($priceEntry['guests']) && (int) $priceEntry['guests'] === $guests) {
                            $totalPrice += (float) $priceEntry['price'];
                            break 2; // Exit both inner loops once price is found
                        }
                    }
                }
            }

            $currentDate->addDay();
        }

        // Apply discounts based on the total days
        foreach ($prices as $price) {
            $totalPrice = $this->applyDiscounts($totalPrice, $price, $arrival->diffInDays($departure) + 1);
        }

        return $totalPrice;
    }

    /**
     * Apply any applicable discounts to the total price.
     *
     * @param float $totalPrice The current total price.
     * @param object $price The price object containing discounts.
     * @param int $totalDays The total number of days in the range.
     * @return float The total price after applying discounts.
     */
    private function applyDiscounts(float $totalPrice, $price, int $totalDays): float
    {
        $discounts = $price->discounts;

        foreach ($discounts as $discount) {
            if (isset($discount['days']) && $totalDays >= $discount['days']) {
                if (isset($discount['discount'])) {
                    $discountValue = rtrim($discount['discount'], '%');
                    $discountPercentage = (float) $discountValue / 100;
                    $totalPrice -= $totalPrice * $discountPercentage;
                }
            }
        }

        return $totalPrice;
    }

    public function store(Request $request, Property $property, CreatesReservations $creator): ReservationCreateResponse
    {
        Gate::authorize('create', Reservation::class);

        $creator->create($property, $request->all());

        return app(ReservationCreateResponse::class, [
            'input' => $request->all(),
            'property' => $property,
        ]);
    }
}
