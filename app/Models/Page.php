<?php

namespace App\Models;

use App\Filters\PageFilters;
use App\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, RecordsActivity;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'title' => 'object',
            'description' => 'object',
            'keywords' => 'object',
        ];
    }

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'can'
    ];

    /**
     * Get the permissions for the current user related to this page.
     *
     * @return array An associative array indicating the user's permissions for the page.
     */
    public function can(): array
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // Return an array of permissions for the current user
            return [
                // Indicates whether the user can delete the page
                'delete-page' => auth()->user()->can('delete', $this),
                // Indicates whether the user can update the page
                'update-page' => auth()->user()->can('update', $this)
            ];
        }

        // Return an empty array if the user is not authenticated
        return [];
    }

    /**
     * Get the value of the "can" attribute.
     *
     * @return array An associative array indicating the user's permissions for the page.
     */
    public function getCanAttribute(): array
    {
        // Delegate to the "can" method to retrieve permissions
        return $this->can();
    }

    /**
     * Filters given query by given filters
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Filters\PageFilters $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, PageFilters $filters): Builder
    {
        return $filters->apply($query);
    }
}
