<?php

namespace App\Actions\Inquiries;

use App\Models\Inquiry;
use App\Rules\AllowedBookingRange;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesInquiries;


class UpdateInquiry implements UpdatesInquiries
{
    /**
     * Validate and update given inquiry.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @param  array<string, string>  $input
     */
    public function update(Inquiry $inquiry, array $input): void
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

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree],
            'email' => ['required', 'email', 'max:255', new SpamFree],
            'phone' => ['required', 'string', 'max:14', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'adults' => ['required', 'integer', 'min:1', 'max:4'],
            'children' => ['required', 'integer', 'min:0', 'max:4'],
            'pets' => ['required', 'boolean'],
            'subject' => ['required', 'string', 'min:4', 'max:64', new SpamFree],
            'message' => ['required', 'string', 'min:10', 'max:1000', new SpamFree],
            'date' => ['nullable', 'array', 'min:2'],
            'date.*' => ['nullable', 'date', new AllowedBookingRange],

        ]);

        //dd($validator);

        $validator->setAttributeNames($attributeNames)->validate();

        foreach ($input['date'] as $key => $value) {
            $input['date'][$key] = \Carbon\Carbon::parse($value)->format('Y-m-d');
        }
        // dd($inquiry);
        $inquiry->forceFill([
            'user_id' => auth()->check() ? auth()->id() : null,
            //'property_id' => $inquiry->property_id,
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'slug' => str($input['subject'])->slug() . '-' . str()->random(4),
            'subject' => $input['subject'],
            'adults' => $input['adults'],
            'pets' => $input['pets'],
            'children' => $input['children'],
            'date' => $input['date'] ?? null,
            'message' => $input['message'],
        ])->save();

        session()->flash('flash.banner', __('Inquiry has been updated.'));
    }
}
