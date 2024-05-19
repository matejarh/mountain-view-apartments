<?php

namespace App\Models;

use App\Traits\HasUUidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $casts = [
        'date' => 'array',
        'date.*' => 'datetime',
        'pets' => 'boolean',
    ];

    public function property( ) :BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
