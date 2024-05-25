<?php

namespace App\Models;

use App\Filters\InquiryFilters;
use App\Traits\HasUUidAsPrimary;
use Illuminate\Database\Eloquent\Builder;
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

    protected $appends = [
        'avatar_url'
    ];

    public function property( ) :BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function owner( ) :BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function getAvatarUrlAttribute(): string
    {
        return "https://api.dicebear.com/8.x/identicon/svg?seed=" . urlencode($this->name . ' ' . $this->email); // icons | pixel-art | ident ...  check https://www.dicebear.com/styles/
    }

        /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\InquiryFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, InquiryFilters $filters): Builder
    {
        return $filters->apply($query);

    }
}
