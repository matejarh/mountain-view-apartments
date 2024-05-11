<?php

namespace App\Models;

use App\Filters\PageFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Page extends Model
{
    use HasFactory, RecordsActivity;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'object',
            'description' => 'object',
            'keywords' => 'object',
        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'can'
    ];

    /**
     * Bootstrap the model and register events.
     *
     * This method is automatically called when the model is being initialized.
     * It registers an event listener to handle the deletion of the page instance.
     * Upon deletion, it detaches all associated galleries and facilities from the page.
     *
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot(); // Call the boot method of the parent class (Model)

        static::deleting(function ($page) { // Register a deleting event listener for the Page model
            foreach ($page->galleries as $gallery) { // Loop through the galleries associated with the page
                $page->galleries()->detach($gallery); // Detach the gallery from the page
            }
        });

        static::creating(function ($property) {
            foreach (config('app.supported_locales') as $key => $value) {
                if (!property_exists($property->title, $value)) {
                    // \Log::info($value.' - isnotset' . property_exists($property->title, $value));
                    $property->title->$value = 'test';
                }
                if (!isset($property->description->$value)) {
                    //\Log::info($value);
                    $property->description->$value = 'test';
                }
                if (!isset($property->keywords->$value)) {
                    //\Log::info($value);
                    $property->keywords->$value = 'test';
                }
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
     * Get galleries for the page
     */
    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'pages_galleries', 'page_id', 'gallery_id')->latest();
    }

    public function langArray() :array
    {
        $langarray = [];
        foreach (config('app.supported_locales') as $key => $value) { $langarray[$value] = ''; }
        return $langarray;
    }

    /**
     * Get the permissions for the current user related to this page.
     *
     * @return array An associative array indicating the user's permissions for the page.
     */
    public function can(): array
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Return an array of permissions for the current user
            return [
                // Indicates whether the user can delete the page
                'delete-page' => auth()->user()->can('delete', $this),
                // Indicates whether the user can update the page
                'update-page' => auth()->user()->can('update', $this)
            ];
        }

        // Return an empty array if the user is not authenticated
        return [];
    }

    /**
     * Get the value of the "can" attribute.
     *
     * @return array An associative array indicating the user's permissions for the page.
     */
    public function getCanAttribute(): array
    {
        // Delegate to the "can" method to retrieve permissions
        return $this->can();
    }

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\PageFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, PageFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
