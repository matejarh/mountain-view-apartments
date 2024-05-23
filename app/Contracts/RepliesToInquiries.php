<?php

namespace App\Contracts;
use App\Models\Inquiry;

interface RepliesToInquiries
{
    /**
     * Replies to given inquiry.
     *
     * @param  array  $input
     * @param  \App\Models\Inquiry  $inquiry
     */
    public function reply(Inquiry $inquiry, array $input);
}
