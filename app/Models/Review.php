<?php

namespace App\Models;

use App\Traits\HasUUidAsPrimary;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Model
{
    use HasFactory, HasUUidAsPrimary;

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function reviewed()
    {
        return $this->MorphTo();
    }

    public function owner() :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approve() :void
    {
        $this->approved_at = now();
        $this->save();
    }

    public function reject() :void
    {
        $this->approved_at = null;
        $this->save();
    }
}
