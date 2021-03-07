<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidIsbn implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->IsbnValidation($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a Valid Iban.';
    }


    private function IsbnValidation(string $isbn)
    {
        if (!is_numeric($isbn)) return false;

        if (Str::length($isbn) !== 10) return false;


        $isbnSplited = collect(array_reverse(str_split($isbn)));
        $totalSum = $isbnSplited->reduce(function ($carry, $value, $key) {
            ++$key;
            return $carry + ($value * $key);
        }, 0);

        return ($totalSum % 11) === 0;
    }
}
