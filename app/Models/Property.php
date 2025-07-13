<?php

namespace App\Models;

use App\Filters\PropertyFilters;
use App\Traits\Likable;
use App\Traits\RecordsActivity;
use App\Traits\Reviewable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;

class Property extends Model
{
    use HasFactory, RecordsActivity, Likable, Reviewable;

    protected $table = 'properties';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    /*     protected $attributes = [
            'title' => $this->langArray(),
            'description' => $this->langArray(),
            'keywords' => $this->langArray(),
            'rules' => $this->langArray(),
        ]; */

    protected $casts = [
        'coordinates' => 'object',
        'bed_types' => 'array',
        'recomended' => 'array',
        'rules' => 'object',
        'is_entire_apartment' => 'boolean',
        'title' => 'object',
        'description' => 'object',
        'quote' => 'object',
        'long_description' => 'object',
        'keywords' => 'object',
    ];

    protected $appends = [
        'can',
        'address_for_map',
        // 'google_maps_link',
        'avatar_url',
        'seo_description',
        'is_liked', // by auth()->user()
        'is_reviewed', // by auth()->user()
        'average_review_score',
        // 'unavailable_dates',
    ];

    /**
     * Bootstrap the model and register events.
     *
     * This method is automatically called when the model is being initialized.
     * It registers an event listener to handle the deletion of the property instance.
     * Upon deletion, it detaches all associated galleries and facilities from the property.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot(); // Call the boot method of the parent class (Model)

        static::deleting(function ($property) { // Register a deleting event listener for the Property model
            $property->galleries()->detach();
            $property->facilities()->detach();
        });

        foreach (static::deleteItems() as $item) {
            static::deleting(function ($user) use ($item) {
                $user->$item->each->delete();
            });
        }
    }

    protected static function deleteItems(): array
    {
        return ['inquiries', 'prices', 'reservations'];
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the user who owns this property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user who owns this property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get the facilities associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'properties_facilities', 'property_id', 'facility_id')->orderBy('name');
    }

    /**
     * Get the galleries associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'properties_galleries', 'property_id', 'gallery_id')->latest();
    }

    /**
     * Get the reservations associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class)->latest();
    }

    /**
     * Get the prices associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    /**
     * Get the disabled days associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function disabled_days(): HasMany
    {
        return $this->hasMany(DisabledDay::class);
    }

    public function langArray(): array
    {
        $langarray = [];
        foreach (config('app.supported_locales') as $key => $value) {
            $langarray[$value] = '';
        }
        return $langarray;
    }

    /**
     * Check the user's permissions related to this property.
     *
     * @return array An associative array indicating whether the authenticated user can delete or update this property.
     */
    public function can(): array
    {
        if (auth()->check()) {
            return [
                'delete-property' => auth()->user()->can('delete', $this),
                'update-property' => auth()->user()->can('update', $this),
                'create-property' => auth()->user()->can('create', $this),
            ];
        }
        return [];
    }

    public function getCanAttribute(): array
    {
        return $this->can();
    }

    /**
     * Get the formatted address for mapping purposes.
     *
     * @return string The formatted address suitable for use in mapping applications.
     */
    public function addressForMap(): string
    {
        return str(trim($this->address))->replace(', ', ',')->replace(' ', '+');
    }

    public function getAddressForMapAttribute(): string
    {
        return $this->addressForMap();
    }

    /**
     * Get the default image avatar URL if no galleries are attached.
     *
     * @return string
     */
    protected function defaultPhotoUrl(): string
    {
        return "https://api.dicebear.com/8.x/pixel-art/svg?seed=" . urlencode($this->slug) . ""; // icons | pixel-art | ident ...  check https://www.dicebear.com/styles/
    }

    public function avatarUrl(): string
    {
        if ($this->galleries->count() > 0 && $this->galleries[0]->images->count() > 0) {
            return $this->galleries[0]->images[0]->thumb_url;
        }
        return $this->defaultPhotoUrl();
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatarUrl();
    }

    public function seoDescription(): array
    {
        $striped = [];
        $defaultLocale = config('app.fallback_locale');
        foreach (config('app.supported_locales') as $key => $locale) {
            // Check if the description for the current locale exists
            if (isset($this->description->$locale)) {
                // If it exists, use it
                $striped[$locale] = strip_tags($this->description->$locale);
            } else {
                // If it doesn't exist, use the English description as fallback
                $striped[$locale] = strip_tags($this->description->$defaultLocale);
            }
        }
        return $striped;
    }
    public function getSeoDescriptionAttribute(): array
    {
        return $this->seoDescription();
    }

    public function getUnavailableDatesAttribute(): array
    {
        return cache()->remember('unavailable_dates_' . $this->id, 60 * 60 * 24, function () {
            return $this->getUnavailableAndUndefinedDates(now(), now()->addYears(7));
        });
    }

    /**
     * Get the current active price for the property.
     *
     * This method filters the prices to find the one that is currently active based on the current date.
     * It returns the first price that is valid for the current date.
     *
     * @return Price|null The currently active price or null if no active price is found.
     */
    public function currentPrices(): ?Price
    {
        $currentDate = Carbon::now();
        // Find the price where current date is between from and to
        return $this->prices()
            ->where('from', '<=', $currentDate)
            ->where('to', '>=', $currentDate)
            ->first();
    }

    public function nextPrices() :Collection
    {
        $currentDate = Carbon::now();

        // Query the database for prices with a 'from' date greater than the current date
        $prices = $this->prices()->where('from', '>', $currentDate)->get();

        return $prices;

    }

    /**
     * Calculate the total price for a given date range and number of guests.
     *
     * @param string $startDate The start date of the range.
     * @param string $endDate The end date of the range.
     * @param int $guests The number of guests to filter by.
     * @return float The calculated total price.
     * @throws \Exception If no prices are available for the given criteria.
     */
    public function calculateTotalPriceForRangeAndGuests(string $startDate, string $endDate, int $guests): float
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // Ensure the start date is before or equal to the end date
        if ($startDate->gt($endDate)) {
            throw new \Exception("Start date must be before or equal to end date.");
        }

        // Fetch relevant prices
        $prices = $this->getPricesForRangeAndGuests($startDate->toDateString(), $endDate->toDateString(), $guests);

        // Check if we found any applicable prices
        if ($prices->isEmpty()) {
            throw new \Exception("No prices available for the given date range and number of guests.");
        }

        $totalPrice = 0.0;
        $currentDate = $startDate->copy();

        // Iterate over each day in the date range
        while ($currentDate->lte($endDate)) {
            foreach ($prices as $price) {
                $priceFrom = Carbon::parse($price->from);
                $priceTo = Carbon::parse($price->to);

                // Check if the current date is within the price's date range
                if ($currentDate->between($priceFrom, $priceTo)) {
                    $priceDetails = $price->prices;

                    // Find the price for the specific number of guests
                    $dailyPrice = $this->findDailyPriceForGuests($priceDetails, $guests);

                    if ($dailyPrice !== null) {
                        $totalPrice += $dailyPrice;
                        break;
                    }
                }
            }

            $currentDate->addDay();
        }

        // Apply discounts if any
        $totalDays = $startDate->diffInDays($endDate) + 1;
        foreach ($prices as $price) {
            $totalPrice = $this->applyDiscounts($totalPrice, $price, $totalDays);
        }

        return $totalPrice;
    }

    /**
     * Find the daily price for a specific number of guests in the price details.
     *
     * @param array $priceDetails The decoded prices array.
     * @param int $guests The number of guests.
     * @return float|null The daily price or null if not found.
     */
    private function findDailyPriceForGuests(array $priceDetails, int $guests): ?float
    {
        foreach ($priceDetails as $detail) {
            if (isset($detail['guests']) && $detail['guests'] == $guests) {
                return (float) $detail['price'];
            }
        }
        return null;
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

    /**
     * Decode the JSON-encoded prices field and handle errors.
     *
     * @param string $prices The JSON-encoded prices field.
     * @return array|null Decoded prices array or null on error.
     */
    private function decodePrices(string $prices): ?array
    {
        $decoded = json_decode($prices, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // Log the error or handle it as needed
            return null;
        }

        return $decoded;
    }

    /**
     * Fetch prices for a given date range and number of guests.
     *
     * @param string $startDate The start date of the range.
     * @param string $endDate The end date of the range.
     * @param int $guests The number of guests.
     * @return Collection The collection of prices.
     */
    private function getPricesForRangeAndGuests(string $startDate, string $endDate, int $guests): Collection
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // Fetch prices within the date range
        $prices = Price::query()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('from', [$startDate, $endDate])
                    ->orWhereBetween('to', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('from', '<=', $startDate)
                            ->where('to', '>=', $endDate);
                    });
            })
            ->get();

        // Filter prices based on the number of guests
        $filteredPrices = $prices->filter(function ($price) use ($guests) {
            $pricesArray = $price->prices;
            foreach ($pricesArray as $priceEntry) {
                if (isset($priceEntry['guests']) && $priceEntry['guests'] == $guests) {
                    return true;
                }
            }
            return false;
        });

        return $filteredPrices->values(); // Reset keys
    }

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\PropertyFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, PropertyFilters $filters): Builder
    {
        return $filters->apply($query);
    }

    public static function fetchListForDropdowns(): \Illuminate\Database\Eloquent\Collection|Collection
    {
        return cache()->rememberForever('properties_list_for_dropdown', function () {
            return Property::latest()->get()->map(function (Property $property) {
                return [
                    'slug' => $property->slug,
                    'type' => $property->type,
                    'title' => $property->title,
                    'avatar_url' => $property->avatar_url,
                ];
            });
        });
    }

    /**
     * Get all unavailable dates within a given date range.
     *
     * @param string $startDate The start date of the range (Y-m-d format).
     * @param string $endDate The end date of the range (Y-m-d format).
     * @return array An array of unavailable dates.
     */
    public function getUnavailableDates(string $startDate, string $endDate): Collection
    {
        // Retrieve confirmed and payment received reservations within the specified date range
        $reservations = $this->reservations()
            ->confirmed()
            ->paymentReceived()
            ->where(function (Builder $query) use ($startDate, $endDate) {
                $query->whereBetween('arrival', [$startDate, $endDate])
                    ->orWhereBetween('departure', [$startDate, $endDate])
                    ->orWhere(function (Builder $query) use ($startDate, $endDate) {
                        $query->where('arrival', '<=', $startDate)
                            ->where('departure', '>=', $endDate);
                    });
            })
            ->get();

        // Initialize a collection to hold the unavailable dates
        $unavailableDates = collect();

        // Loop through each reservation and add the dates to the collection
        $reservations->each(function ($reservation) use ($unavailableDates) {
            $currentDate = Carbon::parse($reservation->arrival);
            $endDate = Carbon::parse($reservation->departure);

            // Generate all dates between arrival and departure and merge into the collection
            while ($currentDate->lte($endDate)) {
                $unavailableDates->push($currentDate->toDateString());
                $currentDate->addDay();
            }
        });

        // Return the unique unavailable dates as an array
        return $unavailableDates->unique();
    }

    /**
     * Get all dates within a given date range that have defined prices.
     *
     * @param string $startDate The start date of the range (Y-m-d format).
     * @param string $endDate The end date of the range (Y-m-d format).
     * @param bool $withPrices
     * @return array An array of dates with defined prices.
     */
    public function getDatesWithDefinedPrices(string $startDate, string $endDate, $withPrices = true): Collection
    {
        // Parse start and end dates using Carbon
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Retrieve prices where prices exist within the specified date range
        $prices = $this->prices()
            ->whereJsonLength('prices', '>', 0)
            ->where(function (Builder $query) use ($start, $end) {
                $query->whereBetween('from', [$start, $end])
                    ->orWhereBetween('to', [$start, $end])
                    ->orWhere(function (Builder $query) use ($start, $end) {
                        $query->where('from', '<=', $start)
                            ->where('to', '>=', $end);
                    });
            })
            ->get();

        // Initialize a collection to hold the dates with defined prices
        $definedDates = collect();

        // Loop through each price range and add the dates to the collection
        foreach ($prices as $price) {
            $priceStart = Carbon::parse($price->from);
            $priceEnd = Carbon::parse($price->to);

            // Generate all dates between price start and end dates and merge into the collection
            while ($priceStart->lte($priceEnd)) {
                $definedDates->push($priceStart->toDateString());
                $priceStart->addDay();
            }
        }

        // Return the unique dates with defined prices
        return $definedDates->unique();
    }

    /**
     * Get all dates within a given date range that do not have defined prices.
     *
     * @param string $startDate The start date of the range (Y-m-d format).
     * @param string $endDate The end date of the range (Y-m-d format).
     * @param bool $withPrices
     * @return array An array of dates without defined prices.
     */
    public function getDatesWithoutDefinedPrices(string $startDate, string $endDate, $withPrices = true): Collection
    {
        // Parse start and end dates using Carbon
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        // Get all dates within the range
        $allDates = collect();
        $currentDate = $start->copy();
        while ($currentDate->lte($end)) {
            $allDates->push($currentDate->toDateString());
            $currentDate->addDay();
        }

        // Get dates with defined prices
        $datesWithDefinedPrices = collect($this->getDatesWithDefinedPrices($startDate, $endDate));

        // Get dates without defined prices by diffing the two collections
        $datesWithoutDefinedPrices = $allDates->diff($datesWithDefinedPrices);

        // Return the dates without defined prices as an array
        return $datesWithoutDefinedPrices->unique();
    }

    /**
     * Get all unavailable and undefined dates within a given date range.
     *
     * @param string $startDate The start date of the range (Y-m-d format).
     * @param string $endDate The end date of the range (Y-m-d format).
     * @return array An array of unavailable and undefined dates.
     */
    public function getUnavailableAndUndefinedDates(string $startDate, string $endDate): array
    {
        $unavailableDates = $this->getUnavailableDates($startDate, $endDate);
        $undefinedPriceDates = $this->getDatesWithoutDefinedPrices($startDate, $endDate, false);

        // Get disabled days as date strings
        $disabledDays = $this->disabled_days->pluck('date');

        $allDates = $unavailableDates->merge($undefinedPriceDates)->merge($disabledDays);

        return $allDates->unique()->values()->all();
    }
}
