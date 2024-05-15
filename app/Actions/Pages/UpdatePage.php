<?php

namespace App\Actions\Pages;

use App\Models\Page;
use App\Rules\SpamFree;
use Illuminate\Support\Facades\Validator;
use App\Contracts\UpdatesPages;
use Illuminate\Validation\Rule;


class UpdatePage implements UpdatesPages
{
    /**
     * Validate and update given page.
     *
     * @param  \App\Models\Page  $page
     * @param  array<string, string>  $input
     */
    public function update(Page $page, array $input): void
    {
        $attributeNames = array(
            'name' => __('Name'),
            'description' => __('Description'),
            'title' => __('Title'),
            'keywords' => __('Keywords'),
        );

        $rules = [
            'name' => ['required', 'string', 'max:255', new SpamFree, Rule::unique('pages')->ignore($page->id)],
            'description' => ['required', 'array', 'min:0'],
            'title' => ['required', 'array', 'min:0'],
            'keywords' => ['required', 'array', 'min:0'],
            'extras' => ['required', 'array', 'min:1'],
        ];

        foreach (config('app.supported_locales') as $key => $locale) {
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

            $rules += [
                "description.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "title.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
                "keywords.$locale" => ['nullable', 'string', 'distinct', new SpamFree],
            ];
        }
        // \Log::info('rules', $rules);
        $validator = Validator::make($input, $rules);
        // dd($validator);
        $validator->setAttributeNames($attributeNames)->validateWithBag('updatingPage');

        $page->forceFill([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'title' => isset($input['title']) ? $input['title'] : $page->title,
            'description' => isset($input['description']) ? $input['description'] : $page->description,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : $page->keywords,
            'extras' => isset($input['extras']) ? $input['extras'] : $page->extras,
        ])->save();

        session()->flash('flash.banner', __('Page has been updated.'));
    }
}
