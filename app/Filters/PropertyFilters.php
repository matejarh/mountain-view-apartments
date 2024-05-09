<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PropertyFilters extends Filters
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
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('type', 'like', '%' . $search . '%')
                ->orWhere('keywords', 'like', '%' . $search . '%')
                ->orWhere('bed_types', 'like', '%' . $search . '%')
                ->orWhere('recomended', 'like', '%' . $search . '%')
                ->orWhere('prices', 'like', '%' . $search . '%')
                ->orWhere('rules', 'like', '%' . $search . '%')
                ->orWhereHas('owner', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })
                ->orWhereHas('facilities', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('text', 'like', '%' . $search . '%');
                });
        });

    }

}
