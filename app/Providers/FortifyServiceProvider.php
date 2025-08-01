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
use App\Actions\Inquiries\AdminCreateInquiry;
use App\Actions\Inquiries\CreateInquiry;
use App\Actions\Inquiries\DeleteInquiry;
use App\Actions\Inquiries\ReplyToInquiry;
use App\Actions\Inquiries\UpdateInquiry;
use App\Actions\Notifications\DeleteAllNotifications;
use App\Actions\Notifications\DeleteNotification;
use App\Actions\Notifications\ReadAllNotifications;
use App\Actions\Notifications\ReadNotification;
use App\Actions\Pages\AttachGallery as AttachPageGallery;
use App\Actions\Pages\CreateNewPage;
use App\Actions\Pages\DeletePage;
use App\Actions\Pages\DetachGallery as DetachPageGallery;
use App\Actions\Pages\UpdatePage;
use App\Actions\Prices\CreatePrice;
use App\Actions\Prices\DeletePrice;
use App\Actions\Prices\UpdatePrice;
use App\Actions\Properties\AttachFacility;
use App\Actions\Properties\AttachGallery as AttachPropertyGallery;
use App\Actions\Properties\CreateNewProperty;
use App\Actions\Properties\DetachFacility;
use App\Actions\Properties\DetachGallery as DetachPropertyGallery;
use App\Actions\Properties\LikeProperty;
use App\Actions\Properties\ReviewProperty;
use App\Actions\Properties\UpdateProperty;
use App\Actions\Reservations\ApprovePayment;
use App\Actions\Reservations\ConfirmReservation;
use App\Actions\Reservations\CreateReservation;
use App\Actions\Reservations\DeleteReservation;
use App\Actions\Reservations\RejectPayment;
use App\Actions\Reservations\RejectReservation;
use App\Actions\Reservations\UpdateReservation;
use App\Actions\Reviews\ApprovesReview;
use App\Actions\Reviews\CreateReview;
use App\Actions\Reviews\DeleteReview;
use App\Actions\Reviews\RejectsReview;
use App\Actions\Reviews\UpdateReview;
use App\Actions\Settings\CreateNewSetting;
use App\Actions\Settings\UpdateSetting;
use App\Actions\Translations\UpdateTranslations;
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
use App\Contracts\GuestInquiryStoreResponse as GuestInquiryStoreResponseContract;
use App\Contracts\ImageAttacheResponse as ImageAttacheResponseContract;
use App\Contracts\ImageCreateResponse as ImageCreateResponseContract;
use App\Contracts\ImageDeleteResponse as ImageDeleteResponseContract;
use App\Contracts\ImageDetacheResponse as ImageDetacheResponseContract;
use App\Contracts\ImageOrderChangeResponse as ImageOrderChangeResponseContract;
use App\Contracts\ImageUpdateResponse as ImageUpdateResponseContract;
use App\Contracts\InquiryCreateResponse as InquiryCreateResponseContract;
use App\Contracts\InquiryDeleteResponse as InquiryDeleteResponseContract;
use App\Contracts\InquiryReplyResponse as InquiryReplyResponseContract;
use App\Contracts\InquiryUpdateResponse as InquiryUpdateResponseContract;
use App\Contracts\NotificationDeleteAllResponse as NotificationDeleteAllResponseContract;
use App\Contracts\NotificationDeleteResponse as NotificationDeleteResponseContract;
use App\Contracts\NotificationReadAllResponse as NotificationReadAllResponseContract;
use App\Contracts\NotificationReadResponse as NotificationReadResponseContract;
use App\Contracts\PageCreateResponse as PageCreateResponseContract;
use App\Contracts\PageDeleteResponse as PageDeleteResponseContract;
use App\Contracts\PageUpdateResponse as PageUpdateResponseContract;
use App\Contracts\PriceCreateResponse as PriceCreateResponseContract;
use App\Contracts\PriceDeleteResponse as PriceDeleteResponseContract;
use App\Contracts\PriceUpdateResponse as PriceUpdateResponseContract;
use App\Contracts\PropertyCreateResponse as PropertyCreateResponseContract;
use App\Contracts\PropertyLikeResponse as PropertyLikeResponseContract;
use App\Contracts\PropertyReviewResponse as PropertyReviewResponseContract;
use App\Contracts\PropertyUpdateResponse as PropertyUpdateResponseContract;
use App\Contracts\ReservationConfirmResponse as ReservationConfirmResponseContract;
use App\Contracts\ReservationCreateResponse as ReservationCreateResponseContract;
use App\Contracts\ReservationDeleteResponse as ReservationDeleteResponseContract;
use App\Contracts\ReservationPaymentApproveResponse as ReservationPaymentApproveResponseContract;
use App\Contracts\ReservationPaymentRejectResponse as ReservationPaymentRejectResponseContract;
use App\Contracts\ReservationRejectResponse as ReservationRejectResponseContract;
use App\Contracts\ReservationUpdateResponse as ReservationUpdateResponseContract;
use App\Contracts\ReviewApproveResponse as ReviewApproveResponseContract;
use App\Contracts\ReviewCreateResponse as ReviewCreateResponseContract;
use App\Contracts\ReviewDeleteResponse as ReviewDeleteResponseContract;
use App\Contracts\ReviewRejectResponse as ReviewRejectResponseContract;
use App\Contracts\ReviewUpdateResponse as ReviewUpdateResponseContract;
use App\Contracts\SettingCreateResponse as SettingCreateResponseContract;
use App\Contracts\SettingUpdateResponse as SettingUpdateResponseContract;
use App\Contracts\TranslationsUpdateResponse as TranslationsUpdateResponseContract;
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
use App\Http\Responses\GuestInquiryStoredResponse;
use App\Http\Responses\ImageAttachedResponse;
use App\Http\Responses\ImageCreatedResponse;
use App\Http\Responses\ImageDeletedResponse;
use App\Http\Responses\ImageDetachedResponse;
use App\Http\Responses\ImageOrderChangedResponse;
use App\Http\Responses\ImageUpdatedResponse;
use App\Http\Responses\InquiryCreatedResponse;
use App\Http\Responses\InquiryDeletedResponse;
use App\Http\Responses\InquiryRepliedResponse;
use App\Http\Responses\InquiryUpdatedResponse;
use App\Http\Responses\NotificationDeletedAllResponse;
use App\Http\Responses\NotificationDeletedResponse;
use App\Http\Responses\NotificationReadedAllResponse;
use App\Http\Responses\NotificationReadedResponse;
use App\Http\Responses\PageCreatedResponse;
use App\Http\Responses\PageDeletedResponse;
use App\Http\Responses\PageUpdatedResponse;
use App\Http\Responses\PriceCreatedResponse;
use App\Http\Responses\PriceDeletedResponse;
use App\Http\Responses\PriceUpdatedResponse;
use App\Http\Responses\PropertyCreatedResponse;
use App\Http\Responses\PropertyLikedResponse;
use App\Http\Responses\PropertyReviewedResponse;
use App\Http\Responses\PropertyUpdatedResponse;
use App\Http\Responses\ReservationConfirmedResponse;
use App\Http\Responses\ReservationCreatedResponse;
use App\Http\Responses\ReservationDeletedResponse;
use App\Http\Responses\ReservationPaymentApprovedResponse;
use App\Http\Responses\ReservationPaymentRejectedResponse;
use App\Http\Responses\ReservationRejectedResponse;
use App\Http\Responses\ReservationUpdatedResponse;
use App\Http\Responses\ReviewApprovedResponse;
use App\Http\Responses\ReviewCreatedResponse;
use App\Http\Responses\ReviewDeletedResponse;
use App\Http\Responses\ReviewRejectedResponse;
use App\Http\Responses\ReviewUpdatedResponse;
use App\Http\Responses\SettingCreatedResponse;
use App\Http\Responses\SettingUpdatedResponse;
use App\Http\Responses\TranslationsUpdatedResponse;
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
        $this->app->singleton(PropertyReviewResponseContract::class, PropertyReviewedResponse::class);

        $this->app->singleton(FacilityAttacheResponseContract::class, FacilityAttachedResponse::class);
        $this->app->singleton(FacilityDetacheResponseContract::class, FacilityDetachedResponse::class);

        $this->app->singleton(PageCreateResponseContract::class, PageCreatedResponse::class);
        $this->app->singleton(PageUpdateResponseContract::class, PageUpdatedResponse::class);
        $this->app->singleton(PageDeleteResponseContract::class, PageDeletedResponse::class);

        $this->app->singleton(FacilityCreateResponseContract::class, FacilityCreatedResponse::class);
        $this->app->singleton(FacilityUpdateResponseContract::class, FacilityUpdatedResponse::class);
        $this->app->singleton(FacilityDeleteResponseContract::class, FacilityDeletedResponse::class);

        $this->app->singleton(InquiryCreateResponseContract::class, InquiryCreatedResponse::class);
        $this->app->singleton(InquiryUpdateResponseContract::class, InquiryUpdatedResponse::class);
        $this->app->singleton(InquiryDeleteResponseContract::class, InquiryDeletedResponse::class);
        $this->app->singleton(InquiryReplyResponseContract::class, InquiryRepliedResponse::class);

        $this->app->singleton(GuestInquiryStoreResponseContract::class, GuestInquiryStoredResponse::class);

        $this->app->singleton(ReviewCreateResponseContract::class, ReviewCreatedResponse::class);
        $this->app->singleton(ReviewUpdateResponseContract::class, ReviewUpdatedResponse::class);
        $this->app->singleton(ReviewDeleteResponseContract::class, ReviewDeletedResponse::class);
        $this->app->singleton(ReviewApproveResponseContract::class, ReviewApprovedResponse::class);
        $this->app->singleton(ReviewRejectResponseContract::class, ReviewRejectedResponse::class);

        $this->app->singleton(NotificationReadResponseContract::class, NotificationReadedResponse::class);
        $this->app->singleton(NotificationReadAllResponseContract::class, NotificationReadedAllResponse::class);
        $this->app->singleton(NotificationDeleteResponseContract::class, NotificationDeletedResponse::class);
        $this->app->singleton(NotificationDeleteAllResponseContract::class, NotificationDeletedAllResponse::class);

        $this->app->singleton(ReservationCreateResponseContract::class, ReservationCreatedResponse::class);
        $this->app->singleton(ReservationUpdateResponseContract::class, ReservationUpdatedResponse::class);
        $this->app->singleton(ReservationDeleteResponseContract::class, ReservationDeletedResponse::class);
        $this->app->singleton(ReservationConfirmResponseContract::class, ReservationConfirmedResponse::class);
        $this->app->singleton(ReservationRejectResponseContract::class, ReservationRejectedResponse::class);
        $this->app->singleton(ReservationPaymentApproveResponseContract::class, ReservationPaymentApprovedResponse::class);
        $this->app->singleton(ReservationPaymentRejectResponseContract::class, ReservationPaymentRejectedResponse::class);

        $this->app->singleton(PriceCreateResponseContract::class, PriceCreatedResponse::class);
        $this->app->singleton(PriceUpdateResponseContract::class, PriceUpdatedResponse::class);
        $this->app->singleton(PriceDeleteResponseContract::class, PriceDeletedResponse::class);

        $this->app->singleton(TranslationsUpdateResponseContract::class, TranslationsUpdatedResponse::class);
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
        AppFortify::reviewPropertyUsing(ReviewProperty::class);

        AppFortify::createPagesUsing(CreateNewPage::class);
        AppFortify::updatePagesUsing(UpdatePage::class);
        AppFortify::destroyPagesUsing(DeletePage::class);
        AppFortify::attachGalleriesToPagesUsing(AttachPageGallery::class);
        AppFortify::detachGalleriesFromPagesUsing(DetachPageGallery::class);

        AppFortify::createFacilitiesUsing(CreateNewFacility::class);
        AppFortify::updateFacilitiesUsing(UpdateFacility::class);
        AppFortify::destroyFacilitiesUsing(DeleteFacility::class);

        AppFortify::createInquiriesUsing(AdminCreateInquiry::class);
        AppFortify::updateInquiriesUsing(UpdateInquiry::class);
        AppFortify::destroyInquiriesUsing(DeleteInquiry::class);
        AppFortify::replyToInquiriesUsing(ReplyToInquiry::class);

        AppFortify::guestCreateInquiriesUsing(CreateInquiry::class);

        AppFortify::createReviewsUsing(CreateReview::class);
        AppFortify::updateReviewsUsing(UpdateReview::class);
        AppFortify::destroyReviewsUsing(DeleteReview::class);
        AppFortify::approveReviewsUsing(ApprovesReview::class);
        AppFortify::rejectReviewsUsing(RejectsReview::class);

        AppFortify::readNotificationsUsing(ReadNotification::class);
        AppFortify::readAllNotificationsUsing(ReadAllNotifications::class);
        AppFortify::destroyNotificationsUsing(DeleteNotification::class);
        AppFortify::destroyAllNotificationsUsing(DeleteAllNotifications::class);

        AppFortify::createReservationsUsing(CreateReservation::class);
        AppFortify::updateReservationsUsing(UpdateReservation::class);
        AppFortify::destroyReservationsUsing(DeleteReservation::class);
        AppFortify::confirmReservationsUsing(ConfirmReservation::class);
        AppFortify::rejectReservationsUsing(RejectReservation::class);
        AppFortify::rejectPaymentsForReservationsUsing(RejectPayment::class);
        AppFortify::approvePaymentsForReservationsUsing(ApprovePayment::class);

        AppFortify::createPricesUsing(CreatePrice::class);
        AppFortify::updatePricesUsing(UpdatePrice::class);
        AppFortify::destroyPricesUsing(DeletePrice::class);

        AppFortify::updateTranslationsUsing(UpdateTranslations::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = str(str($request->input(Fortify::username()))->lower().'|'.$request->ip())->transliterate();

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

    }
}
