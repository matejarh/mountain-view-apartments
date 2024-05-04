<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ImageFilters extends Filters
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
                ->orWhere('description', 'like', '%' . $search . '%')
                ->whereHas('galleries', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
                });
        });

    }

}
