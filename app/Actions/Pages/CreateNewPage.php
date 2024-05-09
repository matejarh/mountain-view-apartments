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

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree, 'unique:pages'],
            'description' => ['required', 'array', 'min:1'],
            'description.*' => ['required', 'string', 'distinct', new SpamFree],
            'title' => ['required', 'array', 'min:1'],
            'title.*' => ['required', 'string', 'distinct', new SpamFree],
            'keywords' => ['required', 'array', 'min:1'],
            'keywords.*' => ['required', 'string', 'distinct', new SpamFree],

        ]);

        $validator->setAttributeNames($attributeNames)->validate();

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
