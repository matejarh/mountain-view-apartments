<?php

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;

class UserFilters extends Filters
{
    protected $filters = ['search'];

    /**
     * Filter the query
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($query) :Builder
    {

        return $this->builder->when($query ?? null, function ($query, $search) {

            $query->where('first_name', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('phone', 'like', '%' . $search . '%')
                ->orWhere('country', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');

        });

    }


}
