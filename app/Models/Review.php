<?php

namespace App\Models;

use App\Filters\ReviewFilters;
use App\Traits\HasUUidAsPrimary;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Review extends Model
{
    use HasFactory, RecordsActivity;

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    protected $appends=[
        'created_at_human_readable',
    ];

    public function reviewed(): MorphTo
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

        /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\ReviewFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, ReviewFilters $filters): Builder
    {
        return $filters->apply($query);

    }

    public function createdAtHumanReadable( ) :string
    {
        return $this->created_at->diffForHumans();
    }

    public function getCreatedAtHumanReadableAttribute() :string
    {
        return $this->createdAtHumanReadable();
    }
}
