<?php

namespace App\Models;

use App\Filters\ReviewFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;

class Review extends Model
{
    use HasFactory, RecordsActivity;

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    protected $appends = [
        'created_at_human_readable',
        'reviewed_trimed',
        'excerpt',
    ];

    protected $with = [
        'owner',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) str()->uuid();
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function reviewed(): MorphTo
    {
        return $this->MorphTo();
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewedTrimed(): Collection
    {
        return $this->reviewed()->get()->map(function ($reviewed) {
            return [
                'name' => $reviewed->name ?: '',
                'slug' => $reviewed->slug ?: '',
                'title' => $reviewed->title ?: '',
                'avatar_url' => $reviewed->avatar_url ?: '',
            ];
        });
    }

    public function excerpt(): string
    {
        return str(strip_tags($this->text))->limit(15);
    }

    public function getExcerptAttribute(): string
    {
        return $this->excerpt();
    }

    function getReviewedTrimedAttribute(): Collection
    {
        return $this->reviewedTrimed();
    }

    public function createdAtHumanReadable(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getCreatedAtHumanReadableAttribute(): string
    {
        return $this->createdAtHumanReadable();
    }

    public function approve(): void
    {
        $this->approved_at = now();
        $this->reviewed()->increment('reviews_count');
        $this->save();
    }

    public function reject(): void
    {
        $this->approved_at = null;
        try {
            //code...
            $this->reviewed()->decrement('reviews_count');
        } catch (\Illuminate\Database\QueryException $th) {
            session()->flash('flash.banner', $th->getMessage());
            session()->flash('flash.bannerStyle', 'danger');
            //throw $th;
        }
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

    public function scopeApproved(Builder $query,) :Builder
    {
        return $query->whereNotNull('approved_at');
    }
}
