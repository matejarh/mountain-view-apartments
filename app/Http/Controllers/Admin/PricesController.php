<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CreatesPrices;
use App\Contracts\DeletesPrices;
use App\Contracts\PriceCreateResponse;
use App\Contracts\PriceDeleteResponse;
use App\Contracts\PriceUpdateResponse;
use App\Contracts\UpdatesPrices;
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PricesController extends Controller
{
    /**
     * Creates new price for givn property with given information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @param  \App\Contracts\CreatesPrices  $creator
     * @return \App\Contracts\PriceCreateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Property $property, CreatesPrices $creator) :PriceCreateResponse
    {
        Gate::authorize('create', Price::class);

        $creator->create($property, $request->all());

        return app(PriceCreateResponse::class);
    }

    /**
     * Updates information for given price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @param  \App\Contracts\UpdatesPrices  $updator
     * @return \App\Contracts\PriceUpdateResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Price $price, UpdatesPrices $updator) :PriceUpdateResponse
    {
        Gate::authorize('update', $price);

        $updator->update($price, $request->all());

        return app(PriceUpdateResponse::class);
    }

    /**
     * Deletes given price.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @param  \App\Contracts\DeletesPrices  $destroyer
     * @return \App\Contracts\PriceDeleteResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Price $price, DeletesPrices $destroyer) :PriceDeleteResponse
    {
        Gate::authorize('delete', $price);

        $destroyer->destroy($price);

        return app(PriceDeleteResponse::class);
    }
}
