<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filters
{
    /**
     * @var Request
     * @var $builder
     */
    protected $request, $builder;

    protected $filters = [];

    /**
     * Filter Constructor
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder): Builder
    {
        $this->builder = $builder;

        // dd($this->getFilters());

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }

            $this->$filter($this->request->$filter);
        }

        return $this->builder;
    }

    public function getFilters() :array
    {
        return $this->request->only($this->filters);
    }
}
