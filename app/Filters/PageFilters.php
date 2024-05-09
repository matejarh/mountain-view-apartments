<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PageFilters extends Filters
{
    protected $filters = ['search'];

    /**
     * Filter the query
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($query): Builder
    {
        return $this->builder->when($query ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('keywords', 'like', '%' . $search . '%');
        });

    }

}
