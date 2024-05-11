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
        ];

        foreach (config('app.supported_locales') as $key => $value) {
            if (!isset($input['title'][$value])) {
                $input['title'][$value] = '';
            }
            if (!isset($input['description'][$value])) {
                $input['description'][$value] = '';
            }
            if (!isset($input['keywords'][$value])) {
                $input['keywords'][$value] = '';
            }
            # code...
            $rules += [
                'description.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'title.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
                'keywords.' . $value => ['nullable', 'string', 'distinct', new SpamFree],
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
        ]);

        session()->flash('flash.banner', __('Page has been created.'));
    }
}
