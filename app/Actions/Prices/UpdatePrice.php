<?php

namespace App\Actions\Prices;

use App\Contracts\UpdatesPrices;
use App\Models\Price;
use App\Rules\AllowedPriceRange;
use Illuminate\Support\Facades\Validator;


class UpdatePrice implements UpdatesPrices
{
    /**
     * Validate and update given Price.
     *
     * @param \App\Models\Price  $price
     * @param  array<string, string>  $input
     */
    public function update(Price $price, array $input): void
    {

        $attributeNames = array(
            'from' => __('From'),
            'to' => __('To'),
            'guests' => __('Guests'),
            'min_days' => __('Minimum Days'),
            'max_days' => __('Daximum Days'),
            'price' => __('Price'),
            'discouns' => __('Discunts'),
        );

        if (isset($input['range'])) {
            $input['from'] = $input['range'][0];
            $input['to'] = $input['range'][1];
        }

        $rules = [
            //'from' => ['date', 'before:to'],
            //'to' => ['date', 'after:from'],
            //'range' => ['array', 'min:2', new AllowedPriceRange($price->property_id, $price->id)],
            'min_days' => ['required', 'min:1', 'integer', 'max:30', 'lt:max_days'],
            'max_days' => ['required', 'min:2', 'integer', 'max:30', 'gt:min_days'],
            'discounts' => ['required', 'array', 'min:0'],
            'discounts.*' => ['required', 'array', 'min:0', 'distinct'],
            'discounts.*.days' => ['required', 'integer', 'min:1'],
            'discounts.*.discount' => ['required', 'string', 'regex:/\d+(\.\d+)?%/'],
            'prices' => ['required', 'array', 'min:1'],
            'prices.*' => ['required', 'array', 'min:1', 'distinct'],
            'prices.*.guests' => ['required', 'integer', 'min:1', 'max:10'],
            'prices.*.price' => ['required', 'string', 'regex:/^[+]?\d+([.]\d+)?$/'],
        ];

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updatingPrice');

        $price->forceFill([
            // 'from' => $input['from'],
            // 'to' => $input['to'],
            // 'guests' => $input['guests'],
            'discounts' => $input['discounts'],
            'min_days' => $input['min_days'],
            'max_days' => $input['max_days'],
            'prices' => $input['prices'],
        ])->save();

        cache()->forget('unavailable_dates_' . $price->property_id);

        session()->flash('flash.banner', __('Price has been updated.'));
    }
}
