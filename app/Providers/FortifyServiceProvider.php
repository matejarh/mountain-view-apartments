<?php

namespace App\Providers;

use App\Actions\Facilities\CreateNewFacility;
use App\Actions\Facilities\DeleteFacility;
use App\Actions\Facilities\UpdateFacility;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Galleries\AttachToImage;
use App\Actions\Galleries\ChangeImagesOrder;
use App\Actions\Galleries\CreateNewGallery;
use App\Actions\Galleries\DetachFromImage;
use App\Actions\Galleries\UpdateGallery;
use App\Actions\Galleries\DeleteGallery;
use App\Actions\Images\AttachToGallery;
use App\Actions\Images\CreateNewImage;
use App\Actions\Images\DeleteImage;
use App\Actions\Images\DetachFromGallery;
use App\Actions\Images\UpdateImage;
use App\Actions\Pages\AttachGallery as AttachPageGallery;
use App\Actions\Pages\CreateNewPage;
use App\Actions\Pages\DeletePage;
use App\Actions\Pages\DetachGallery as DetachPageGallery;
use App\Actions\Pages\UpdatePage;
use App\Actions\Properties\AttachFacility;
use App\Actions\Properties\AttachGallery as AttachPropertyGallery;
use App\Actions\Properties\CreateNewProperty;
use App\Actions\Properties\DetachFacility;
use App\Actions\Properties\DetachGallery as DetachPropertyGallery;
use App\Actions\Properties\LikeProperty;
use App\Actions\Properties\UpdateProperty;
use App\Actions\Settings\CreateNewSetting;
use App\Actions\Settings\UpdateSetting;
use App\Contracts\FacilityAttacheResponse as FacilityAttacheResponseContract;
use App\Contracts\FacilityCreateResponse as FacilityCreateResponseContract;
use App\Contracts\FacilityDeleteResponse as FacilityDeleteResponseContract;
use App\Contracts\FacilityDetacheResponse as FacilityDetacheResponseContract;
use App\Contracts\FacilityUpdateResponse as FacilityUpdateResponseContract;
use App\Contracts\GalleryAttacheResponse as GalleryAttacheResponseContract;
use App\Contracts\GalleryCreateResponse as GalleryCreateResponseContract;
use App\Contracts\GalleryDeleteResponse as GalleryDeleteResponseContract;
use App\Contracts\GalleryDetacheResponse as GalleryDetacheResponseContract;
use App\Contracts\GalleryUpdateResponse as GalleryUpdateResponseContract;
use App\Contracts\ImageAttacheResponse as ImageAttacheResponseContract;
use App\Contracts\ImageCreateResponse as ImageCreateResponseContract;
use App\Contracts\ImageDeleteResponse as ImageDeleteResponseContract;
use App\Contracts\ImageDetacheResponse as ImageDetacheResponseContract;
use App\Contracts\ImageOrderChangeResponse as ImageOrderChangeResponseContract;
use App\Contracts\ImageUpdateResponse as ImageUpdateResponseContract;
use App\Contracts\PageCreateResponse as PageCreateResponseContract;
use App\Contracts\PageDeleteResponse as PageDeleteResponseContract;
use App\Contracts\PageUpdateResponse as PageUpdateResponseContract;
use App\Contracts\PropertyCreateResponse as PropertyCreateResponseContract;
use App\Contracts\PropertyLikeResponse as PropertyLikeResponseContract;
use App\Contracts\PropertyUpdateResponse as PropertyUpdateResponseContract;
use App\Contracts\SettingCreateResponse as SettingCreateResponseContract;
use App\Contracts\SettingUpdateResponse as SettingUpdateResponseContract;
use App\Http\Responses\FacilityAttachedResponse;
use App\Http\Responses\FacilityCreatedResponse;
use App\Http\Responses\FacilityDeletedResponse;
use App\Http\Responses\FacilityDetachedResponse;
use App\Http\Responses\FacilityUpdatedResponse;
use App\Http\Responses\GalleryAttachedResponse;
use App\Http\Responses\GalleryCreatedResponse;
use App\Http\Responses\GalleryDeletedResponse;
use App\Http\Responses\GalleryDetachedResponse;
use App\Http\Responses\GalleryUpdatedResponse;
use App\Http\Responses\ImageAttachedResponse;
use App\Http\Responses\ImageCreatedResponse;
use App\Http\Responses\ImageDeletedResponse;
use App\Http\Responses\ImageDetachedResponse;
use App\Http\Responses\ImageOrderChangedResponse;
use App\Http\Responses\ImageUpdatedResponse;
use App\Http\Responses\PageCreatedResponse;
use App\Http\Responses\PageDeletedResponse;
use App\Http\Responses\PageUpdatedResponse;
use App\Http\Responses\PropertyCreatedResponse;
use App\Http\Responses\PropertyLikedResponse;
use App\Http\Responses\PropertyUpdatedResponse;
use App\Http\Responses\SettingCreatedResponse;
use App\Http\Responses\SettingUpdatedResponse;
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
        $this->app->singleton(GalleryAttacheResponseContract::class, GalleryAttachedResponse::class);
        $this->app->singleton(GalleryDetacheResponseContract::class, GalleryDetachedResponse::class);
        $this->app->singleton(ImageOrderChangeResponseContract::class, ImageOrderChangedResponse::class);

        $this->app->singleton(ImageCreateResponseContract::class, ImageCreatedResponse::class);
        $this->app->singleton(ImageDeleteResponseContract::class, ImageDeletedResponse::class);
        $this->app->singleton(ImageUpdateResponseContract::class, ImageUpdatedResponse::class);
        $this->app->singleton(ImageAttacheResponseContract::class, ImageAttachedResponse::class);
        $this->app->singleton(ImageDetacheResponseContract::class, ImageDetachedResponse::class);

        $this->app->singleton(SettingCreateResponseContract::class, SettingCreatedResponse::class);
        $this->app->singleton(SettingUpdateResponseContract::class, SettingUpdatedResponse::class);

        $this->app->singleton(PropertyCreateResponseContract::class, PropertyCreatedResponse::class);
        $this->app->singleton(PropertyUpdateResponseContract::class, PropertyUpdatedResponse::class);
        $this->app->singleton(PropertyLikeResponseContract::class, PropertyLikedResponse::class);

        $this->app->singleton(FacilityAttacheResponseContract::class, FacilityAttachedResponse::class);
        $this->app->singleton(FacilityDetacheResponseContract::class, FacilityDetachedResponse::class);

        $this->app->singleton(PageCreateResponseContract::class, PageCreatedResponse::class);
        $this->app->singleton(PageUpdateResponseContract::class, PageUpdatedResponse::class);
        $this->app->singleton(PageDeleteResponseContract::class, PageDeletedResponse::class);

        $this->app->singleton(FacilityCreateResponseContract::class, FacilityCreatedResponse::class);
        $this->app->singleton(FacilityUpdateResponseContract::class, FacilityUpdatedResponse::class);
        $this->app->singleton(FacilityDeleteResponseContract::class, FacilityDeletedResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AppFortify::createGalleriesUsing(CreateNewGallery::class);
        AppFortify::updateGalleriesUsing(UpdateGallery::class);
        AppFortify::destroyGalleriesUsing(DeleteGallery::class);
        AppFortify::attachImagesToGalleriesUsing(AttachToImage::class);
        AppFortify::detachImagesFromGalleriesUsing(DetachFromImage::class);
        AppFortify::changeImagesOrderUsing(ChangeImagesOrder::class);

        AppFortify::createImagesUsing(CreateNewImage::class);
        AppFortify::updateImagesUsing(UpdateImage::class);
        AppFortify::destroyImagesUsing(DeleteImage::class);
        AppFortify::attachGalleriesToImagesUsing(AttachToGallery::class);
        AppFortify::detachGalleriesFromImagesUsing(DetachFromGallery::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        AppFortify::createSettingsUsing(CreateNewSetting::class);
        AppFortify::updateSettingsUsing(UpdateSetting::class);

        AppFortify::createPropertiesUsing(CreateNewProperty::class);
        AppFortify::updatePropertiesUsing(UpdateProperty::class);
        AppFortify::attachFacilitiesToPropertiesUsing(AttachFacility::class);
        AppFortify::detachFacilitiesFromPropertiesUsing(DetachFacility::class);
        AppFortify::attachGalleriesToPropertiesUsing(AttachPropertyGallery::class);
        AppFortify::detachGalleriesFromPropertiesUsing(DetachPropertyGallery::class);
        AppFortify::toggleLikeForPropertyUsing(LikeProperty::class);

        AppFortify::createPagesUsing(CreateNewPage::class);
        AppFortify::updatePagesUsing(UpdatePage::class);
        AppFortify::destroyPagesUsing(DeletePage::class);
        AppFortify::attachGalleriesToPagesUsing(AttachPageGallery::class);
        AppFortify::detachGalleriesFromPagesUsing(DetachPageGallery::class);

        AppFortify::createFacilitiesUsing(CreateNewFacility::class);
        AppFortify::updateFacilitiesUsing(UpdateFacility::class);
        AppFortify::destroyFacilitiesUsing(DeleteFacility::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = str(str($request->input(Fortify::username()))->lower().'|'.$request->ip())->transliterate();

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
