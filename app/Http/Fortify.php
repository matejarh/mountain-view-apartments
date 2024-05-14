<?php
namespace App\Http;
use App\Contracts\AttachesFacilitiesToProperties;
use App\Contracts\AttachesGalleriesToImages;
use App\Contracts\AttachesGalleriesToPages;
use App\Contracts\AttachesGalleriesToProperties;
use App\Contracts\AttachesImagesToGalleries;
use App\Contracts\ChangesImagesOrder;
use App\Contracts\CreatesNewFacilities;
use App\Contracts\CreatesNewGalleries;
use App\Contracts\CreatesNewImages;
use App\Contracts\CreatesNewPages;
use App\Contracts\CreatesNewProperties;
use App\Contracts\CreatesNewSettings;
use App\Contracts\DeletesFacilities;
use App\Contracts\DeletesGalleries;
use App\Contracts\DeletesImages;
use App\Contracts\DeletesPages;
use App\Contracts\DetachesFacilitiesFromProperties;
use App\Contracts\DetachesGalleriesFromImages;
use App\Contracts\DetachesGalleriesFromPages;
use App\Contracts\DetachesGalleriesFromProperties;
use App\Contracts\DetachesImagesFromGalleries;
use App\Contracts\UpdatesFacilities;
use App\Contracts\UpdatesGalleries;
use App\Contracts\UpdatesImages;
use App\Contracts\UpdatesPages;
use App\Contracts\UpdatesProperties;
use App\Contracts\UpdatesSettings;

class Fortify
{
    /**
     * Register a class / callback that should be used to create new pages.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createPagesUsing(string $callback)
    {
        app()->singleton(CreatesNewPages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update given page.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updatePagesUsing(string $callback)
    {
        app()->singleton(UpdatesPages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to destroyes given page.
     *
     * @param  string  $callback
     * @return void
     */
    public static function destroyPagesUsing(string $callback)
    {
        app()->singleton(DeletesPages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to attach given gallery to given page.
     *
     * @param  string  $callback
     * @return void
     */
    public static function attachGalleriesToPagesUsing(string $callback)
    {
        app()->singleton(AttachesGalleriesToPages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to detach given gallery from given page.
     *
     * @param  string  $callback
     * @return void
     */
    public static function detachGalleriesFromPagesUsing(string $callback)
    {
        app()->singleton(DetachesGalleriesFromPages::class, $callback);
    }

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
     * Register a class / callback that should be used to update given gallery.
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
     * Register a class / callback that should be used to change images order for given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function changeImagesOrderUsing(string $callback)
    {
        app()->singleton(ChangesImagesOrder::class, $callback);
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

    /**
     * Register a class / callback that should be used to attach given image to given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function attachImagesToGalleriesUsing(string $callback)
    {
        app()->singleton(AttachesImagesToGalleries::class, $callback);
    }

    /**
     * Register a class / callback that should be used to attach given gallery to given image.
     *
     * @param  string  $callback
     * @return void
     */
    public static function attachGalleriesToImagesUsing(string $callback)
    {
        app()->singleton(AttachesGalleriesToImages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to detach given image from given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function detachImagesFromGalleriesUsing(string $callback)
    {
        app()->singleton(DetachesImagesFromGalleries::class, $callback);
    }

    /**
     * Register a class / callback that should be used to detach given gallery from given image.
     *
     * @param  string  $callback
     * @return void
     */
    public static function detachGalleriesFromImagesUsing(string $callback)
    {
        app()->singleton(DetachesGalleriesFromImages::class, $callback);
    }

    /**
     * Register a class / callback that should be used to create new settings.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createSettingsUsing(string $callback)
    {
        app()->singleton(CreatesNewSettings::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update given setting.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateSettingsUsing(string $callback)
    {
        app()->singleton(UpdatesSettings::class, $callback);
    }

    /**
     * Register a class / callback that should be used to create new properties.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createPropertiesUsing(string $callback)
    {
        app()->singleton(CreatesNewProperties::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update given property.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updatePropertiesUsing(string $callback)
    {
        app()->singleton(UpdatesProperties::class, $callback);
    }

    /**
     * Register a class / callback that should be used to attach given facility to given property.
     *
     * @param  string  $callback
     * @return void
     */
    public static function attachFacilitiesToPropertiesUsing(string $callback)
    {
        app()->singleton(AttachesFacilitiesToProperties::class, $callback);
    }

    /**
     * Register a class / callback that should be used to detach given facility from given property.
     *
     * @param  string  $callback
     * @return void
     */
    public static function detachFacilitiesFromPropertiesUsing(string $callback)
    {
        app()->singleton(DetachesFacilitiesFromProperties::class, $callback);
    }

    /**
     * Register a class / callback that should be used to attach given gallery to given property.
     *
     * @param  string  $callback
     * @return void
     */
    public static function attachGalleriesToPropertiesUsing(string $callback)
    {
        app()->singleton(AttachesGalleriesToProperties::class, $callback);
    }

    /**
     * Register a class / callback that should be used to detach given gallery from given property.
     *
     * @param  string  $callback
     * @return void
     */
    public static function detachGalleriesFromPropertiesUsing(string $callback)
    {
        app()->singleton(DetachesGalleriesFromProperties::class, $callback);
    }

        /**
     * Register a class / callback that should be used to create new galleries.
     *
     * @param  string  $callback
     * @return void
     */
    public static function createFacilitiesUsing(string $callback)
    {
        app()->singleton(CreatesNewFacilities::class, $callback);
    }

    /**
     * Register a class / callback that should be used to update given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function updateFacilitiesUsing(string $callback)
    {
        app()->singleton(UpdatesFacilities::class, $callback);
    }

    /**
     * Register a class / callback that should be used to destroyes given gallery.
     *
     * @param  string  $callback
     * @return void
     */
    public static function destroyFacilitiesUsing(string $callback)
    {
        app()->singleton(DeletesFacilities::class, $callback);
    }
}
