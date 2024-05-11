<?php

namespace App\Actions\Properties;

use App\Models\Property;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewProperties;


class CreateNewProperty implements CreatesNewProperties
{
    /**
     * Validate and create new property.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'type' => __('Type'),
            'title' => __('Title'),
            'address' => __('Address'),
            'keywords' => __('Keywords'),
            'is_entire_apartment' => __('Iis Entire Apartment'),
            'bed_types' => __('Bed Types'),
            'recomended' => __('Recomended'),
            'prices' => __('Prices'),
            'rules' => __('Rules'),
        );

        $rules = [
            'type' => ['required', 'string', 'max:255', new SpamFree] ,
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:properties'],
            'description' => ['required', 'array', 'min:1'],
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
            # code...
            $rules += [
                'description.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'title.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'keywords.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'rules.' . $value => ['required', 'array', 'distinct', 'min:1'],
                'rules.' . $value . '.*.title' => ['nullable', 'string', new SpamFree],
                'rules.' . $value . '.*.description' => ['nullable', 'string', new SpamFree],
                'rules.' . $value . '.*.name' => ['nullable', 'string', new SpamFree],
            ];
        }

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingProperty');

        Property::forceCreate([
            'user_id' => auth()->id(),
            'name' => $input['name'],
            'type' => $input['type'],
            'slug' => str($input['name'])->slug(),
            'description' => isset($input['description']) ? $input['description'] : null,
            'title' => isset($input['title']) ? $input['title'] : null,
            'address' => isset($input['address']) ? $input['address'] : null,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : null,
            'is_entire_apartment' => $input['is_entire_apartment'],
            'coordinates' => isset($input['coordinates']) ? $input['coordinates'] : null,
            'bed_types' => isset($input['bed_types']) ? $input['bed_types'] : null,
            'recomended' => isset($input['recomended']) ? $input['recomended'] : null,
            'prices' => isset($input['prices']) ? $input['prices'] : null,
            'rules' => isset($input['rules']) ? $input['rules'] : null,
        ]);

        session()->flash('flash.banner', __('Property has been created.'));
    }
}
