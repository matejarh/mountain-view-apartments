<?php
namespace App\Http;
use App\Contracts\CreatesNewGalleries;
use App\Contracts\CreatesNewImages;
use App\Contracts\UpdatesGalleries;
use App\Contracts\UpdatesImages;

class Fortify
{
    /**
     * Register a class / callback that should be used to create new galleries.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createGalleriesUsing(string $callback)
    {
        app()->singleton(CreatesNewGalleries::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update new galleries.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateGalleriesUsing(string $callback)
    {
        app()->singleton(UpdatesGalleries::class, $callback);
    }

    /**
     * Register a class / callback that should be used to create new images.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createImagesUsing(string $callback)
    {
        app()->singleton(CreatesNewImages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update new images.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateImagesUsing(string $callback)
    {
        app()->singleton(UpdatesImages::class, $callback);
    }
}
