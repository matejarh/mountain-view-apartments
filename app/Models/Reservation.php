<?php

namespace App\Models;

use App\Traits\HasUUidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $casts = [
        'guests' => 'object',
        'date' => 'array',
        'confirmed_at' => 'datetime',
        'payment_received_at' => 'datetime',
    ];

    protected $appends = [
        'can',
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
}
