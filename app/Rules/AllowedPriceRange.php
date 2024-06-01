<?php

namespace App\Rules;

use App\Models\Price;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedPriceRange implements ValidationRule
{
    protected $propertyId;

    protected $selfId;

    public function __construct($propertyId, $selfId = null)
    {
        $this->propertyId = $propertyId;
        $this->selfId = $selfId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exist = Price::where('property_id', $this->propertyId)
            ->whereNot('id', $this->selfId)
            ->where(function($query) use ($value) {
                $query->whereBetween('from', [$value[0], $value[1]])
                    ->orWhereBetween('to', [$value[0], $value[1]])
                    ->orWhere(function ($query) use ($value) {
                        $query->where('from', '<=', $value[0])
                            ->where('to', '>=', $value[1]);
                    });

            })->exists();

        if ($exist) {
            $fail(__('The selected date range overlaps with existing.'));
        }
    }
}
