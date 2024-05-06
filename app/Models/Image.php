<?php

namespace App\Models;

use App\Filters\ImageFilters;
use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Request;
use Illuminate\Database\Eloquent\Builder;

class Image extends Model
{
    use HasFactory, HasPhoto;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'photo_url',
        'thumb_url',
        'can'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($image) {
            foreach ($image->galleries as $gallery) {
                $image->galleries()->detach($gallery);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get galleries list this image belons to
     */
    public function galleries(): BelongsToMany
    {
        return $this->belongsToMany(Gallery::class, 'galleries_images', 'image_id', 'gallery_id')->latest();
    }

    /**
     * Get user that owns image
     *      */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function can(): array
    {
        if (auth()->check()) {

            return [
                'delete-image' => auth()?->user()->can('delete', $this),
                'update-image' => auth()?->user()->can('update', $this)
            ];
        }
        return [];
    }

    public function getCanAttribute(): array
    {
        return $this->can();
    }

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\ImageFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter(Builder $query, ImageFilters $filters): Builder
    {
        return $filters->apply($query);
        /* $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->whereHas('galleries', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
        }); */
    }
}
