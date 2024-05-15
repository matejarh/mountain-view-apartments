<?php

namespace App\Actions\Pages;

use App\Models\Page;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\CreatesNewPages;


class CreateNewPage implements CreatesNewPages
{
    /**
     * Validate and create new Page.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input)
    {

        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'title' => __('Title'),
            'keywords' => __('Keywords'),
        );

        $rules = [
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:pages'],
            'description' => ['required', 'array', 'min:1'],
            'title' => ['required', 'array', 'min:1'],
            'keywords' => ['required', 'array', 'min:1'],
            'extras' => ['required', 'array', 'min:1'],
        ];

        foreach (config('app.supported_locales') as $key => $locale) {
            if (!isset($input['title'][$locale])) {
                $input['title'][$locale] = '';
            }
            if (!isset($input['description'][$locale])) {
                $input['description'][$locale] = '';
            }
            if (!isset($input['keywords'][$locale])) {
                $input['keywords'][$locale] = '';
            }
            if (isset($input['extras'])) {
                foreach ($input['extras'] as $ekey => $extra) {

                    if (!isset($input['extras'][$ekey]['title'][$locale])) {
                        $input['extras'][$ekey]['title'][$locale] = '';
                    }
                    if (!isset($input['extras'][$ekey]['text'][$locale])) {
                        $input['extras'][$ekey]['text'][$locale] = '';
                    }

                    $rules += [
                        "extras.$ekey.title.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                        "extras.$ekey.text.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                    ];
                }
            }
            # code...
            $rules += [
                'description.' . $locale => ['nullable', 'string', 'distinct', new SpamFree],
                'title.' . $locale => ['nullable', 'string', 'distinct', new SpamFree],
                'keywords.' . $locale => ['nullable', 'string', 'distinct', new SpamFree],
            ];
        }

        $validator = Validator::make($input, $rules);

        $validator->setAttributeNames($attributeNames)->validateWithBag('creatingPage');

        Page::forceCreate([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'title' => $input['title'],
            'description' => isset($input['description']) ? $input['description'] : null,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : null,
            'extras' => isset($input['extras']) ? $input['extras'] : null,
        ]);

        session()->flash('flash.banner', __('Page has been created.'));
    }
}
