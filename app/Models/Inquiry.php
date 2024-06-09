<?php

namespace App\Models;

use App\Filters\InquiryFilters;
use App\Traits\HasUUidAsPrimary;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory, HasUUidAsPrimary, RecordsActivity;

    protected $casts = [
        'date' => 'array',
        'date.*' => 'datetime',
        'pets' => 'boolean',
    ];

    protected $appends = [
        'avatar_url',
        'property_basic_info',
        'created_at_human_readable',
    ];

    protected static function getActivitiesToRecord(): array
    {
        return ['created'];
    }

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

    public function getPropertyBasicInfoAttribute() :array
    {
        $property = \DB::table('properties')->select('name', 'title')->where('id', $this->property->id)->first();
        return [
            'name' => $this->property->name,
            'title' => $this->property->title,
            'avatar_url' => $this->property->avatar_url,
        ];
    }

    public function createdAtHumanReadable(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getCreatedAtHumanReadableAttribute(): string
    {
        return $this->createdAtHumanReadable();
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
