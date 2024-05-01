<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gallery extends Model
{
    use HasFactory;


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
    public function owner() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * Get images for the gallery
     */
    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'galleries_images', 'gallery_id', 'image_id');
    }
}
