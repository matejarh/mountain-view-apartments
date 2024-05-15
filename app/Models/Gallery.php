<?php

namespace App\Models;

use App\Filters\GalleryFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gallery extends Model
{
    use HasFactory, RecordsActivity;


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'can'
    ];

    protected $with = [
        'images',
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
            foreach ($gallery->properties as $property) {
                $gallery->properties()->detach($property);
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
        return $this->belongsToMany(Image::class, 'galleries_images', 'gallery_id', 'image_id')
                    ->withPivot('order')
                    ->withTimestamps()
                    ->orderBy('galleries_images.order');
                    //->orderByRaw('CONVERT(galleries_images.order, SIGNED) asc');
    }

    /**
     * Get images for the gallery
     */
    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'properties_galleries', 'gallery_id', 'property_id')->latest();
    }

    /**
     * Get pages for the gallery
     */
    public function pages(): BelongsToMany
    {
        return $this->belongsToMany(Page::class, 'pages_galleries', 'gallery_id', 'page_id')->latest();
    }

    public function can(): array
    {
        if (auth()->check()) {
            return [
                'delete-gallery' => auth()->user()->can('delete', $this),
                'update-gallery' => auth()->user()->can('update', $this)
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
     * @param \App\Filters\GalleryFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, GalleryFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
