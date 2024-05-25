<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class InquiryFilters extends Filters
{
    protected $filters = ['search', 'answered', 'notAnswered'];

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
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('subject', 'like', '%' . $search . '%')
                ->orWhere('message', 'like', '%' . $search . '%');
        });

    }


    public function answered() :Builder
    {
        return  $this->builder->whereNotNull('read_at');
    }

    public function notAnswered($query) :Builder
    {
        return $this->builder->whereNull('read_at');
    }

}
