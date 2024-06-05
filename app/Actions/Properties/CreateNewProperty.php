<?php

namespace App\Actions\Properties;

use App\Models\Property;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewProperties;

class CreateNewProperty implements CreatesNewProperties
{
    /**
     * Validate and create a new property.
     *
     * @param array<string, string> $input The input data containing the property information.
     * @return void
     */
    public function create(array $input): void
    {
        $attributeNames = $this->getAttributeNames();
        $rules = $this->getValidationRules();

        $this->fillMissingLocales($input);

        $validator = Validator::make($input, $rules);
        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingProperty');

        Property::forceCreate($this->getPropertyAttributes($input));

        cache()->forget('properties_list_for_dropdown');

        session()->flash('flash.banner', __('Property has been created.'));
    }

    /**
     * Get attribute names for validation.
     *
     * @return array Attribute names.
     */
    private function getAttributeNames(): array
    {
        return [
            'name' => __('Name'),
            'description' => __('Description'),
            'type' => __('Type'),
            'title' => __('Title'),
            'address' => __('Address'),
            'keywords' => __('Keywords'),
            'is_entire_apartment' => __('Is Entire Apartment'),
            'bed_types' => __('Bed Types'),
            'recomended' => __('Recommended'),
            'rules' => __('Rules'),
        ];
    }

    /**
     * Get validation rules for creating a property.
     *
     * @return array Validation rules.
     */
    private function getValidationRules(): array
    {
        $rules = [
            'type' => ['required', 'string', 'max:255', new SpamFree],
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:properties'],
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
            $input['title'][$locale] = $input['title'][$locale] ?? $input['title'][config('app.fallback_locale')] ?? '';
            $input['quote'][$locale] = $input['quote'][$locale] ?? $input['quote'][config('app.fallback_locale')] ?? '';
            $input['description'][$locale] = $input['description'][$locale] ?? $input['description'][config('app.fallback_locale')] ?? '';
            $input['long_description'][$locale] = $input['long_description'][$locale] ?? $input['long_description'][config('app.fallback_locale')] ?? '';
            $input['keywords'][$locale] = $input['keywords'][$locale] ?? $input['keywords'][config('app.fallback_locale')] ?? '';
            $input['rules'][$locale] = $input['rules'][$locale] ?? $input['rules'][config('app.fallback_locale')] ?? [];
        }
    }

    /**
     * Get property attributes for creation.
     *
     * @param array $input The validated input data.
     * @return array Property attributes.
     */
    private function getPropertyAttributes(array $input): array
    {
        return [
            'user_id' => auth()->id(),
            'name' => $input['name'],
            'type' => $input['type'],
            'slug' => str($input['name'])->slug(),
            'description' => $input['description'] ?? null,
            'quote' => $input['quote'] ?? null,
            'long_description' => $input['long_description'] ?? null,
            'title' => $input['title'] ?? null,
            'address' => $input['address'] ?? null,
            'keywords' => $input['keywords'] ?? null,
            'is_entire_apartment' => $input['is_entire_apartment'],
            'coordinates' => $input['coordinates'] ?? null,
            'bed_types' => $input['bed_types'] ?? null,
            'recomended' => $input['recomended'] ?? null,
            'rules' => $input['rules'] ?? null,
        ];
    }
}
