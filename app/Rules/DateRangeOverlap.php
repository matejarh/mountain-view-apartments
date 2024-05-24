<?php

namespace App\Rules;

use App\Models\Reservation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRangeOverlap implements ValidationRule
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
        $exist = Reservation::whereNot('id', $this->selfId)->where('property_id', $this->propertyId)
            ->where(function ($query) use ($value) {
                $query->whereBetween('arrival', [$value[0], $value[1]])
                    ->orWhereBetween('departure', [$value[0], $value[1]])
                    ->orWhere(function ($query) use ($value) {
                        $query->where('arrival', '<=', $value[0])
                            ->where('departure', '>=', $value[1]);
                    })
                    /* ->orWhere(function ($query) {
                        $query->where('arrival', '<', $this->departure)
                            ->where('departure', '>', $this->arrival);
                    }) */;
            })->exists();

        //dd($exist);

        if ($exist) {
            $fail(__('The selected date range is not available.'));
        }
    }
}
