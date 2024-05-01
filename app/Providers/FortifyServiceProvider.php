<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Galleries\CreateNewGallery;
use App\Actions\Galleries\UpdateGallery;
use App\Actions\Gallerys\DeleteGallery;
use App\Actions\Images\CreateNewImage;
use App\Actions\Images\DeleteImage;
use App\Actions\Images\UpdateImage;
use App\Contracts\GalleryCreateResponse as GalleryCreateResponseContract;
use App\Contracts\GalleryDeleteResponse as GalleryDeleteResponseContract;
use App\Contracts\GalleryUpdateResponse as GalleryUpdateResponseContract;
use App\Contracts\ImageCreateResponse as ImageCreateResponseContract;
use App\Contracts\ImageDeleteResponse as ImageDeleteResponseContract;
use App\Contracts\ImageUpdateResponse as ImageUpdateResponseContract;
use App\Http\Responses\GalleryCreatedResponse;
use App\Http\Responses\GalleryDeletedResponse;
use App\Http\Responses\GalleryUpdatedResponse;
use App\Http\Responses\ImageCreatedResponse;
use App\Http\Responses\ImageDeletedResponse;
use App\Http\Responses\ImageUpdatedResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Http\Fortify as AppFortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerResponseBindings();
    }

    /**
     * Register the response bindings.
     *
     * @return void
     */
    protected function registerResponseBindings()
    {
        $this->app->singleton(GalleryCreateResponseContract::class, GalleryCreatedResponse::class);
        $this->app->singleton(GalleryUpdateResponseContract::class, GalleryUpdatedResponse::class);
        $this->app->singleton(GalleryDeleteResponseContract::class, GalleryDeletedResponse::class);

        $this->app->singleton(ImageCreateResponseContract::class, ImageCreatedResponse::class);
        $this->app->singleton(ImageDeleteResponseContract::class, ImageDeletedResponse::class);
        $this->app->singleton(ImageUpdateResponseContract::class, ImageUpdatedResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AppFortify::createGalleriesUsing(CreateNewGallery::class);
        AppFortify::updateGalleriesUsing(UpdateGallery::class);
        AppFortify::destroyGalleriesUsing(DeleteGallery::class);

        AppFortify::createImagesUsing(CreateNewImage::class);
        AppFortify::updateImagesUsing(UpdateImage::class);
        AppFortify::destroyImagesUsing(DeleteImage::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = str(str($request->input(Fortify::username()))->lower().'|'.$request->ip())->transliterate();

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
