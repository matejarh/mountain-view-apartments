<?php

namespace App\Contracts;
use App\Models\Inquiry;

interface DeletesInquiries
{
    /**
     * Destroyes given inquiry.
     *
     * @param  \App\Models\Inquiry $inquiry
     */
    public function destroy(Inquiry $inquiry);
}
