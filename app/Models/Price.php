<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    protected $casts = [
        'from' => 'datetime',
        'to' => 'datetime',
        'prices' => 'array',
        'discounts' => 'array',
    ];

    protected $appends = [
        'is_active',
    ];

    /**
     * Get the property who owns this price.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Determen if price is active
     */
    public function isActive() :bool
    {
        if (Carbon::parse($this->from) <= now() && Carbon::parse($this->to >= now())) return true;

        return false;
    }

    public function getIsActiveAttribute() :bool
    {
        return $this->isActive();
    }

    public function scopeActive(Builder $query) :Builder
    {
        return $query->where('to', '<=', now())
                ->where('from', '>=', now());

    }
}
