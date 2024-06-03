<?php

namespace App\Actions\Prices;


use App\Contracts\DeletesPrices;
use App\Models\Price;


class DeletePrice implements DeletesPrices
{
    /**
     * Deletes given price.
     *
     * @param \App\Models\Price  $price
     */
    public function destroy(Price $price): void
    {
        $price->delete();

        cache()->forget('unavailable_dates_' . $price->property_id);

        session()->flash('flash.banner', __('Price has been deleted.'));
    }
}
