<?php

namespace App\Actions\Inquiries;

use App\Contracts\RepliesToInquiries;
use App\Models\Inquiry;
use App\Models\User;
use App\Notifications\ReplyToInquiry as ReplyToInquiryNotification;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;



class ReplyToInquiry implements RepliesToInquiries
{
    /**
     * Validate and update given inquiry.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @param  array<string, string>  $input
     */
    public function reply(Inquiry $inquiry, array $input): void
    {
        $lang = app()->currentLocale();

        $input['subject'] = __("Reply to your inquiry about") . $inquiry->property->title->$lang;

        $validator = Validator::make($input, [
            'subject' => ['required', 'string', 'min:10', 'max:255', new SpamFree],
            'text' => ['required', 'string', 'min:10', 'max:1000', new SpamFree],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $validator->validate();

        if ($inquiry->owner) {
            Notification::send($inquiry->owner, new ReplyToInquiryNotification($input, $inquiry));
        } else {
            Notification::route('mail', [
                $input['email'] => $input['email'],
            ])->notify(new ReplyToInquiryNotification($input, $inquiry));
        }

        $inquiry->forceFill([
            'read_at' => now(),
        ])->save();

        session()->flash('flash.banner', __('Reply has been sent.'));
    }
}
