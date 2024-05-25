<?php

namespace App\Actions\Properties;

use App\Contracts\ReviewsProperties;
use App\Models\Property;
use App\Models\User;
use App\Notifications\Admin\ReviewReceived;
use App\Rules\Recaptcha;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;


class ReviewProperty implements ReviewsProperties
{
    /**
     * Reviews given property
     *
     * @param  \App\Models\Property  $property
     * @param  \array  $input
     */
    public function review(Property $property, array $input): void
    {

        $locale = app()->currentLocale();
        $rules = [
            'score' => ['required', 'integer', 'max:5', 'min:1'],
            'text' => ['required', 'string', 'max:255', 'min:10', new SpamFree],
            'captcha_token' => [new Recaptcha],
        ];
        $validator = Validator::make($input, $rules);


        $validator->after(function ($validator) use ($property) {
            if ($property->isReviewed()) {
                $validator->errors()->add(
                    'text',
                    'Already reviewed'
                );
            }
        });


        $validator->validateWithBag('reviewingProperty');

        if (!$property->isReviewed()) {
            $review = $property->review($input['score'], $input['text']);

            Notification::send(User::adminsMailingList(), new ReviewReceived($review));

            session()->flash('flash.banner', __('You have reviewed') . ' ' . $property->title->$locale . '.');
            session()->flash('flash.bannerStyle', 'success');
        }
    }
}
