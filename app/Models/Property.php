<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Property extends Pivot
{
    use HasFactory;

    protected $table = 'properties';

    public function owner() : BelongsTo {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
