<?php

namespace App\Models;

use App\Filters\GalleryFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gallery extends Model
{
    use HasFactory;


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'can'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::deleting(function ($gallery) {
            foreach ($gallery->images as $image) {
                $gallery->images()->detach($image);
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
     * Get the owner of the gallery.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get images for the gallery
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'galleries_images', 'gallery_id', 'image_id')->latest();
    }

    public function can(): array
    {
        return [
            'delete-gallery' => auth()->user()->can('delete', $this),
            'update-gallery' => auth()->user()->can('update', $this)
        ];
    }

    public function getCanAttribute(): array
    {
        return $this->can();
    }

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\GalleryFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, GalleryFilters $filters): Builder
    {
        return $filters->apply($query);
        /* $query->when($filters['search'] ?? null, function ($query, $search) {

            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->whereHas('images', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
        }); */
    }
}
