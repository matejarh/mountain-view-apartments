<?php

namespace App\Actions\Properties;

use App\Contracts\ReviewsProperties;
use App\Models\Property;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;


class ReviewProperty implements ReviewsProperties
{
    /**
     * Reviews given property
     *
     * @param  \App\Models\Property  $property
     * @param  \array  $input
     */
    public function review( Property $property, array $input): void
    {
        $rules = [
            'score' => ['required', 'integer', 'max:5', 'min:1'] ,
            'text' => ['required', 'string', 'max:255', new SpamFree, 'unique:properties'],
        ];
        $validator = Validator::make($input, $rules);

        $validator->validateWithBag('reviewingProperty');

        $property->review($input['score'], $input['text']);

        $locale = app()->currentLocale();

        session()->flash('flash.banner', __('You have reviewed').' '.$property->title->$locale.'.');
    }
}
