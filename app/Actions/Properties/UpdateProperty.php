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
     * @param Property $property The property instance to be updated.
     * @param array $input The input data containing the updated property information.
     * @return void
     */
    public function update(Property $property, array $input): void
    {
        $attributeNames = [
            'name' => __('Name'),
            'description' => __('Description'),
            'type' => __('Type'),
            'address' => __('Address'),
            'keywords' => __('Keywords'),
            'is_entire_apartment' => __('Is Entire Apartment'),
            'bed_types' => __('Bed Types'),
            'facilities' => __('Facilities'),
            'recomended' => __('Recommended'),
            'rules' => __('Rules'),
            'coordinates.lng' => __('Longitude'),
            'coordinates.lat' => __('Latitude'),
        ];

        $rules = $this->getValidationRules($property);

        $this->fillMissingLocales($input);

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('updatingProperty');

        $this->updatePropertyAttributes($property, $input);

        cache()->forget('properties_list_for_dropdown');

        session()->flash('flash.banner', __('Property has been updated.'));
    }

    /**
     * Get validation rules for updating a property.
     *
     * @param Property $property The property instance.
     * @return array Validation rules.
     */
    private function getValidationRules(Property $property): array
    {
        $rules = [
            'type' => ['required', 'string', 'max:255', new SpamFree],
            'name' => ['required', 'string', 'max:255', new SpamFree, Rule::unique('properties')->ignore($property->id)],
            'description' => ['required', 'array', 'min:1'],
            'quote' => ['required', 'array', 'min:1'],
            'long_description' => ['required', 'array', 'min:1'],
            'keywords' => ['required', 'array', 'min:1'],
            'title' => ['required', 'array', 'min:1'],
            'address' => ['required', 'string', 'max:255', new SpamFree],
            'is_entire_apartment' => ['required', 'boolean'],
            'coordinates' => ['required', 'array', 'min:2', 'max:2'],
            'bed_types' => ['required', 'array', 'min:1'],
            'bed_types.*' => ['required', 'array', 'distinct', 'min:1'],
            'recomended' => ['required', 'array', 'min:1'],
            'recomended.*' => ['required', 'array', 'distinct', 'min:1'],
            'recomended.*.title' => ['required', 'string', 'distinct', new SpamFree],
            'rules' => ['required', 'array', 'min:1'],
        ];

        foreach (config('app.supported_locales') as $locale) {
            $rules += [
                "description.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "quote.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "long_description.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "title.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "keywords.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "rules.$locale" => ['required', 'array', 'distinct', 'min:0'],
                "rules.$locale.*.title" => ['nullable', 'string', new SpamFree],
                "rules.$locale.*.description" => ['nullable', 'string', new SpamFree],
                "rules.$locale.*.name" => ['nullable', 'string', new SpamFree],
            ];
        }

        return $rules;
    }

    /**
     * Fill missing locales in the input data.
     *
     * @param array $input The input data.
     * @return void
     */
    private function fillMissingLocales(array &$input): void
    {
        foreach (config('app.supported_locales') as $locale) {
            $input['title'][$locale] = $input['title'][$locale] ?? '';
            $input['quote'][$locale] = $input['quote'][$locale] ?? '';
            $input['description'][$locale] = $input['description'][$locale] ?? '';
            $input['long_description'][$locale] = $input['long_description'][$locale] ?? '';
            $input['keywords'][$locale] = $input['keywords'][$locale] ?? '';
            $input['rules'][$locale] = $input['rules'][$locale] ?? $input['rules'][config('app.fallback_locale')] ?? [];
        }
    }

    /**
     * Update property attributes with validated input data.
     *
     * @param Property $property The property instance.
     * @param array $input The validated input data.
     * @return void
     */
    private function updatePropertyAttributes(Property $property, array $input): void
    {
        $property->forceFill([
            'name' => $input['name'],
            'type' => $input['type'],
            'slug' => str($input['name'])->slug(),
            'description' => $input['description'],
            'quote' => $input['quote'],
            'long_description' => $input['long_description'],
            'title' => $input['title'],
            'address' => $input['address'],
            'keywords' => $input['keywords'],
            'is_entire_apartment' => $input['is_entire_apartment'],
            'coordinates' => $input['coordinates'],
            'bed_types' => $input['bed_types'],
            'recomended' => $input['recomended'],
            'rules' => $input['rules'],
        ])->save();
    }
}
