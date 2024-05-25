<?php

namespace App\Models;

use App\Filters\ReservationFilters;
use App\Traits\HasUUidAsPrimary;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $casts = [
        'guests' => 'object',
        'arrival' => 'datetime',
        'departure' => 'datetime',
        'confirmed_at' => 'datetime',
        'payment_received_at' => 'datetime',
    ];

    protected $appends = [
        'can',
        'localized_arrival',
        'localized_departure',
        'excerpt',
    ];

    public function owner() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function property() :BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function can(): array
    {
        if (auth()->check()) {
            return [
                'delete-reservation' => auth()->user()->can('delete', $this),
                'update-reservation' => auth()->user()->can('update', $this),
                'create-reservation' => auth()->user()->can('create', $this)
            ];
        }
        return [];
    }

    public function getCanAttribute(): array
    {
        return $this->can();
    }

    public function getLocalizedArrivalAttribute() :string
    {
        return \Carbon\Carbon::parse($this->arrival)->locale(app()->currentLocale())->isoFormat('LLLL');
    }

    public function getLocalizedDepartureAttribute() :string
    {
        return \Carbon\Carbon::parse($this->departure)->locale(app()->currentLocale())->isoFormat('LLLL');
    }


    public function excerpt(): string
    {
        return str(strip_tags($this->message))->limit(15);
    }

    public function getExcerptAttribute(): string
    {
        return $this->excerpt();
    }


    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\ReservationFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, ReservationFilters $filters): Builder
    {
        return $filters->apply($query);

    }

    /**
     * Confirmes reservation
     */
    public function confirm() :void
    {
        $this->confirmed_at = now();
        $this->save();
    }

    /**
     * Confirmes reservation
     */
    public function reject() :void
    {
        $this->confirmed_at = null;
        $this->save();
    }

    /**
     * Approve payment
     */
    public function approvePayment() :void
    {
        $this->payment_received_at = now();
        $this->save();
    }

    /**
     * Reject payment
     */
    public function rejectPayment() :void
    {
        $this->payment_received_at = null;
        $this->save();
    }
}
