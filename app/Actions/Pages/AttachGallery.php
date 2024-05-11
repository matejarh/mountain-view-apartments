<?php

namespace App\Actions\Pages;

use App\Contracts\AttachesGalleriesToPages;
use App\Models\Page;
use App\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttachGallery implements AttachesGalleriesToPages
{
    /**
     * Attaches given page to given gallery.
     *
     * @param  \App\Models\Page  $page
     * @param  \App\Models\Gallery  $gallery
     */
    public function attach(Gallery $gallery, Page $page): void
    {
        // dd($page);
        $input = [
            'page_id' => $page->id,
            'gallery_id' => $gallery->id,
        ];

        $attributeNames = array(
            'page_id' => __('Page'),
            'gallery_id' => __('Gallery'),
        );

        $validator = Validator::make($input, [
            'page_id' => ['required', Rule::unique('pages_galleries')->where(function ($query) use($input) {
                                            return $query->where('page_id', $input['page_id'])
                                                        ->where('gallery_id', $input['gallery_id']);
                                        })],
            'gallery_id' => ['required', Rule::unique('pages_galleries')->where(function ($query) use($input) {
                                                return $query->where('page_id', $input['page_id'])
                                                            ->where('gallery_id', $input['gallery_id']);
                                            })],
                                        ],[
        ]);

        $validator->setAttributeNames($attributeNames)->validateWithBag('attachingToPage');

        $page->galleries()->attach($gallery);

        session()->flash('flash.banner', __('Gallery has been attached to the page.'));
    }
}
