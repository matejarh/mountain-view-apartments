<?php

namespace App\Actions\Inquiries;

use App\Contracts\DeletesInquiries;
use App\Models\Inquiry;

class DeleteInquiry implements DeletesInquiries
{
    /**
     * Deletes given inquiry.
     *
     * @param  \App\Models\Inquiry  $inquiry
     */
    public function destroy(Inquiry $inquiry): void
    {
        $inquiry->delete();

        session()->flash('flash.banner', __('Inquiry has been deleted.'));
        session()->flash('flash.bannerStyle', 'danger');
    }
}
