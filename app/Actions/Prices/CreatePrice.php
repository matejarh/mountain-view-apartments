<?php

namespace App\Actions\Prices;

use App\Contracts\CreatesPrices;
use App\Models\Property;
use App\Rules\AllowedPriceRange;
use Illuminate\Support\Facades\Validator;


class CreatePrice implements CreatesPrices
{
    /**
     * Validate and create new Price for given Property.
     *
     * @param \App\Models\Property  $property
     * @param  array<string, string>  $input
     */
    public function create(Property $property, array $input): void
    {

        $attributeNames = array(
            'from' => __('From'),
            'to' => __('To'),
        );

        /* $input['from'] = \Carbon\Carbon::parseFromLocale($input['range'][0], app()->currentLocale())->format('Y-m-d') . ' 00:00:00';
        $input['to'] = \Carbon\Carbon::parseFromLocale($input['range'][1], app()->currentLocale())->format('Y-m-d') . ' 00:00:00'; */
        $input['from'] = $input['range'][0];
        $input['to'] = $input['range'][1];

        $rules = [
            'from' => ['required', 'date', 'before:to' ],
            'to' => ['required', 'date', 'after:from' ],
            'range' => ['required', 'array', 'min:2', new AllowedPriceRange($property->id)],
            'prices' => ['array', 'min:0'],
            'prices.*' => ['array', 'min:0', 'distinct'],
            'prices.*.guests' => ['integer', 'min:1', 'max:10'],
            'prices.*.price' => ['string', 'regex:/^[+]?\d+([.]\d+)?$/'],
        ];

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingPrice');

        $property->prices()->forceCreate([
            'from' => $input['from'],
            'to' => $input['to'],
            // 'guests' => $input['guests'],
            'prices' => $input['prices'],
        ]);

        session()->flash('flash.banner', __('Price has been created.'));
    }
}
