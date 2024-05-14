<?php

namespace App\Models;

use App\Filters\PropertyFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Property extends Model
{
    use HasFactory, RecordsActivity;

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
        'prices' => 'array',
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
     * Get the facilities associated with the property.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function facilities(): BelongsToMany
    {
        return $this->belongsToMany(Facility::class, 'properties_facilities', 'property_id', 'facility_id')->latest();
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

    public function langArray() :array
    {
        $langarray = [];
        foreach (config('app.supported_locales') as $key => $value) { $langarray[$value] = ''; }
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

    public function avatarUrl( ) :string
    {
        return $this->galleries->count() > 0 ? $this->galleries[0]->images[0]->thumb_url : $this->defaultPhotoUrl();
    }

    public function getAvatarUrlAttribute( ) :string
    {
        return $this->avatarUrl();
    }

    public function seoDescription( ) :array
    {
        $striped = [];
        foreach (config('app.supported_locales') as $key => $locale) {
            $striped[$locale] = strip_tags($this->description->$locale);
        }
        return $striped;
    }
    public function getSeoDescriptionAttribute( ) :array
    {
        return $this->seoDescription();
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
}
