<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Property extends Pivot
{
    use HasFactory;

    protected $table = 'properties';

    protected $casts = [
        'bed_types' => 'object',
        'recomended' => 'array',
        'prices' => 'array',
        'rules' => 'array',
    ];

    protected $appends = [
        'can',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function facilities() : BelongsToMany {
        return $this->belongsToMany(Facility::class, 'properties_facilities', 'property_id', 'facility_id')->latest();
    }

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
}
