<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ReviewFilters extends Filters
{
    protected $filters = ['search', 'approved', 'notApproved'];

    /**
     * Filter the query
     *
     * @param string $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function search($query): Builder
    {
        return $this->builder->when($query ?? null, function ($query, $search) {
                    $query->where('text', 'like', '%' . $search . '%')
                        ->orWhereHas('owner', function ($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('reviewed', function($q) use ($search) {
                            $q->where('name', 'like', '%' . $search . '%');
                        });
        });


    }

    public function approved() :Builder
    {
        return  $this->builder->whereNotNull('approved_at');

    }

    public function notApproved($query) :Builder
    {
        return $this->builder->whereNull('approved_at');
    }
}
