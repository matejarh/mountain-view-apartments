<?php
namespace App\Http;
use App\Contracts\CreatesNewGalleries;
use App\Contracts\CreatesNewImages;
use App\Contracts\DeletesGalleries;
use App\Contracts\DeletesImages;
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
     * Register a class / callback that should be used to destroyes given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function destroyGalleriesUsing(string $callback)
    {
        app()->singleton(DeletesGalleries::class, $callback);
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
     * Register a class / callback that should be used to update given image.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateImagesUsing(string $callback)
    {
        app()->singleton(UpdatesImages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to destroy given image.
     *
     * @param  string  $callback
     * @return void
     */
    public static function destroyImagesUsing(string $callback)
    {
        app()->singleton(DeletesImages::class, $callback);
    }
}
