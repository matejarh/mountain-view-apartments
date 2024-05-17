<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AllowedBookingRange implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $today = now();
        $oneYearFromNow = now()->addYear();
        //dd($value);
        if($value <= $today || $value > $oneYearFromNow)
            $fail(__('The :attribute must be a date after today and before one year from now.'));


    }
}
