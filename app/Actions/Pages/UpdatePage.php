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

        //dd($input['description']['en']);
        //\Log::debug('update', $input['description']);

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'max:255', new SpamFree, Rule::unique('pages')->ignore($page->id)],
            'description' => ['nullable', 'array', 'min:1'],
            'description.*' => ['nullable', 'string', 'distinct', new SpamFree],
            'title' => ['nullable', 'array', 'min:1'],
            'title.*' => ['nullable', 'string', 'distinct', new SpamFree],
            'keywords' => ['nullable', 'array', 'min:1'],
            'keywords.*' => ['nullable', 'string', 'distinct', new SpamFree],
        ]);

        $validator->setAttributeNames($attributeNames)->validate();

        $page->forceFill([
            'name' => $input['name'],
            'slug' => str($input['name'])->slug(),
            'title' => isset($input['title']) ? $input['title'] : $page->title,
            'description' => isset($input['description']) ? $input['description'] : $page->description,
            'keywords' => isset($input['keywords']) ? $input['keywords'] : $page->keywords,
        ])->save();

        session()->flash('flash.banner', __('Page has been updated.'));
    }
}
