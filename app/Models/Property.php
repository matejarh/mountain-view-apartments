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
        'google_maps_link',
        'avatar_url',
        'seo_description',
        'is_liked',
        'is_reviewed',
        'average_review_score',
        'unavailable_dates',
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
            foreach ($property->galleries as $gallery) { // Loop through the galleries associated with the property
                $property->galleries()->detach($gallery); // Detach the gallery from the property
            }
            foreach ($property->facilities as $facility) { // Loop through the facilities associated with the property
                $property->facilities()->detach($facility); // Detach the facility from the property
            }
        });

        foreach (static::deleteItems() as $item) {
            static::deleting(function ($user) use ($item) {
                $i = $item;
                $user->$i->each->delete();
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
                'update-property' => auth()->user()->can('update', $this)
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

    public function googleMapsLink(): string
    {
        return "https://www.google.com/maps/dir//$this->addressForMap/@" . $this->coordinates->lat . "," . $this->coordinates->lng . ",14z/data=!4m9!4m8!1m0!1m5!1m1!1s0x477a09798b922fb5:0xf7d971fcde3bcafe!2m2!1d13.3809776!2d46.618689!3e0?entry=ttu";
    }

    public function getGoogleMapsLinkAttribute(): string
    {
        return $this->googleMapsLink();
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
        return $this->galleries->count() > 0 ? $this->galleries[0]->images[0]->thumb_url : $this->defaultPhotoUrl();
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
        // Get the current date and time
        $currentDate = Carbon::now();

        // Filter the prices collection to find prices that are valid for the current date
        $filteredPrices = $this->prices->filter(function ($price) use ($currentDate) {
            $fromDate = Carbon::parse($price->from);
            $toDate = Carbon::parse($price->to);
            return $fromDate->lte($currentDate) && $toDate->gte($currentDate);
        });

        // Return the first valid price or null if none is found
        return $filteredPrices->first();
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

    public function fetchListForDropdowns(): \Illuminate\Database\Eloquent\Collection|Collection
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
        return $definedDates->unique()/* ->values()->all() */ ;
    }

    /**
     * Get all dates within a given date range that do not have defined prices.
     *
     * @param string $startDate The start date of the range (Y-m-d format).
     * @param string $endDate The end date of the range (Y-m-d format).
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
        $definedPricesDates = $this->getDatesWithoutDefinedPrices($startDate, $endDate, false);

        $allDates = $unavailableDates->merge($definedPricesDates);

        return $allDates->unique()->values()->all();
    }
}
