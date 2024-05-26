<?php

namespace App\Actions\Inquiries;

use App\Contracts\StoresGuestInquiry;
use App\Models\Inquiry;
use App\Models\Property;
use App\Models\User;
use App\Notifications\Admin\InquiryReceivedNotification;
use App\Rules\AllowedBookingRange;
use App\Rules\DateRangeOverlap;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewInquiries;


class CreateInquiry implements StoresGuestInquiry
{
    /**
     * Validate and create new inquiry.
     *
     * @param  array<string, string>  $input
     */
    public function create(Property $property, array $input)
    {
        $attributeNames = array(
            'name' => __('Name'),
            'email' => __('Email'),
            'phone' => __('Phone'),
            'adults' => __('Adults'),
            'children' => __('Children'),
            'pets' => __('Pets'),
            'subject' => __('Subject'),
            'message' => __('Message'),
            'date' => __('Date'),
        );

        $arrival = \Carbon\Carbon::parseFromLocale($input['date'][0], app()->currentLocale())->format('Y-m-d') . ' 16:00:00';
        $departure = \Carbon\Carbon::parseFromLocale($input['date'][1], app()->currentLocale())->format('Y-m-d') . ' 12:00:00';
        $propertyId = $property->id;

        $input['date_range'] = [$arrival,$departure];

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'email' => ['required', 'email', 'max:255', new SpamFree],
            'phone' => ['required', 'string', 'max:10', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'adults' => ['required', 'integer', 'min:1', 'max:4'],
            'children' => ['required', 'integer', 'min:0', 'max:4'],
            'pets' => ['required', 'boolean'],
            'subject' => ['required', 'string', 'min:4', 'max:64', new SpamFree],
            'message' => ['required', 'string', 'min:10', 'max:1000', new SpamFree],
            'date' => ['required', 'array', 'min:2'],
            'date.*' => ['required', 'date', new AllowedBookingRange],
            'date_range' => [new DateRangeOverlap($propertyId)],
            'captcha_token' => [new Recaptcha],

        ]);

        //dd($validator);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingInquiry');

        foreach ($input['date'] as $key => $value) {
            $input['date'][$key] = \Carbon\Carbon::parse($value)->format('Y-m-d');
        }

        $inquiry = $property->inquiries()->forceCreate([
            'user_id' => auth()->check() ? auth()->id() : null,
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'slug' => str($input['subject'])->slug() . '-' . str()->random(4),
            'subject' => $input['subject'],
            'adults' => $input['adults'],
            'pets' => $input['pets'],
            'children' => $input['children'],
            'date' => $input['date'],
            'message' => $input['message'],
        ]);

        //dd($inquiry);

        Notification::send(User::adminsMailingList(), new InquiryReceivedNotification($inquiry->fresh()));

        session()->flash('flash.banner', __('Inquiry has been submited.'));
    }
}
