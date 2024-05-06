<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Facility extends Model
{
    use HasFactory;

    protected $appends = [
        'can',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($facility) {
            foreach ($facility->properties as $property) {
                $facility->properties()->detach($property);
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

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'properties_facilities', 'facility_id', 'property_id')->latest();
    }

    public function can(): array
    {
        if (auth()->check()) {
            return [
                'delete-facility' => auth()->user()->can('delete', $this),
                'update-facility' => auth()->user()->can('update', $this)
            ];
        }
        return [];
    }

    public function getCanAttribute(): array
    {
        return $this->can();
    }
}
