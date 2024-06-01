<?php

namespace App\Contracts;
use App\Models\Price;

interface UpdatesPrices
{
    /**
     * Validate and update  information for given price.
     *
     * @param \App\Models\Price $price
     * @param  array  $input
     */
    public function update(Price $price, array $input);
}
