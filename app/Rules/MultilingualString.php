<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MultilingualString implements ValidationRule
{
    protected $languages;

    public function __construct(array $languages)
    {
        $this->languages = $languages;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($this->languages as $language) {
            try {

                if (!isset($value[$language]) || empty(trim($value[$language]))) {
                    return true;
                }
            } catch (\Exception $e) {
                $fail($e->getMessage());
            }
        }


    }
}
