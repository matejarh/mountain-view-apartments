<?php

namespace App\Actions\Pages;

use App\Contracts\DeletesPages;
use App\Models\Page;

class DeletePage implements DeletesPages
{
    /**
     * Deletes given page.
     *
     * @param  \App\Models\Page  $page
     */
    public function destroy(Page $page): void
    {
        $page->delete();

        session()->flash('flash.banner', __('Page has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
