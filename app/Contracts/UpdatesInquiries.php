<?php

namespace App\Contracts;
use App\Models\Inquiry;

interface UpdatesInquiries
{
    /**
     * Updates given inquiry.
     *
     * @param  array $input
     * @param  \App\Models\Inquiry $property
     */
    public function update(Inquiry $property, array $input);
}
