<?php

namespace App\Contracts;
use App\Models\Price;

interface DeletesPrices
{
    /**
     * Destroyes given price.
     *
     * @param  \App\Models\Price $price
     */
    public function destroy(Price $price);
}
