<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReservationFilters extends Filters
{
    protected $filters = ['search', 'confirmed', 'rejected', 'paymentReceived', 'paymentNotReceived'];

    /**
     * Filter the query
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($query): Builder
    {
        return $this->builder->when($query ?? null, function ($query, $search) {
            $query->where('message', 'like', '%' . $search . '%')
                ->orWhereHas('owner', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhereHas('property', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('title->*', 'like', '%' . $search . '%');
                });
        });


    }

    public function confirmed(): Builder
    {
        return $this->builder->whereNotNull('confirmed_at');

    }

    public function rejected($query): Builder
    {
        return $this->builder->whereNull('confirmed_at');
    }

    public function paymentReceived(): Builder
    {
        return $this->builder->whereNotNull('payment_received_at');

    }

    public function paymentNotReceived($query): Builder
    {
        return $this->builder->whereNull('payment_received_at');
    }
}
