<?php

namespace App\Actions\Properties;

use App\Models\Property;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesProperties;
use Illuminate\Validation\Rule;


class UpdateProperty implements UpdatesProperties
{
    /**
     * Update the specified property.
     *
     * @param  Property $property The property instance to be updated.
     * @param  array $input The input data containing the updated property information.
     * @return void
     */
    public function update(Property $property, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'type' => __('Type'),
            'address' => __('Address'),
            'keywords' => __('Keywords'),
            'is_entire_apartment' => __('Iis Entire Apartment'),
            'bed_types' => __('Bed Types'),
            'facilities' => __('Facilities'),
            'recomended' => __('Recomended'),
            'prices' => __('Prices'),
            'prices.*.guests' => __('Number of guests'),
            'prices.*.price' => __('Price'),
            'rules' => __('Rules'),
            'coordinates.lng' => __('Longitude'),
            'coordinates.lat' => __('Latitude'),
        );

        $rules = [
            'type' => ['required', 'string', 'max:255', new SpamFree] ,
            'name' => ['required', 'string', 'max:255', new SpamFree, Rule::unique('properties')->ignore($property->id)],
            'description' => ['required', 'array', 'min:1'],
            'long_description' => ['required', 'array', 'min:1'],
            'keywords' => ['required', 'array', 'min:1'],
            'title' => ['required', 'array', 'min:1'],
            'address' => ['required', 'string', 'max:255', new SpamFree] ,
            'is_entire_apartment' => ['required', 'boolean'],
            'coordinates' => ['required', 'array', 'min:2', 'max:2'],
            'bed_types' => ['required', 'array', 'min:1'],
            'bed_types.*' => ['required', 'array', 'distinct', 'min:1'],
            'recomended' => ['required', 'array', 'min:1'],
            'recomended.*' => ['required', 'string', 'distinct', new SpamFree],
            'prices' => ['required', 'array', 'min:1'],
            'prices.*' => ['required', 'array', 'distinct', 'min:2', 'max:2'],
            'prices.*.guests' => ['required', 'integer', 'min:1', 'max:30'],
            'prices.*.price' => ['required', 'string', new SpamFree],
            'rules' => ['required', 'array', 'min:1'],
        ];

        foreach (config('app.supported_locales') as $key => $value) {
            $rules += [
                'description.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'long_description.' . $value => ['nullable', 'string', 'distinct'],
                'title.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'keywords.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'rules.' . $value => ['required', 'array', 'distinct', 'min:1'],
                'rules.' . $value . '.*.title' => ['nullable', 'string', new SpamFree],
                'rules.' . $value . '.*.description' => ['nullable', 'string', new SpamFree],
                'rules.' . $value . '.*.name' => ['nullable', 'string', new SpamFree],
            ];
        }

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updatingProperty');
        //dd($input['description']);
        $property->forceFill([
            'name' => $input['name'],
            'type' => $input['type'],
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : $property->description,
            'long_description' => isset($input['long_description']) ? $input['long_description'] : $property->long_description,
            'title' => isset($input['title']) ? $input['title'] : $property->title,
            'address' => isset($input['address']) ? $input['address'] : $property->address,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : $property->keywords,
            'is_entire_apartment' => $input['is_entire_apartment'],
            'coordinates' => isset($input['coordinates']) ? $input['coordinates'] : $property->coordinates,
            'bed_types' => isset($input['bed_types']) ? $input['bed_types'] : $property->bed_types,
            'recomended' => isset($input['recomended']) ? $input['recomended'] : $property->recomended,
            'prices' => isset($input['prices']) ? $input['prices'] : $property->prices,
            'rules' => isset($input['rules']) ? $input['rules'] : $property->rules,
        ])->save();

        session()->flash('flash.banner', __('Property has been updated.'));
    }
}
