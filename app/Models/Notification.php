<?php

namespace App\Models;

use App\Traits\HasUUidAsPrimary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $appends = [
        'created_at_human_readable',
    ];


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedAtHumanReadableAttribute(): string
    {
        return $this->created_at->locale(app()->currentLocale())->diffForHumans();
    }
}
