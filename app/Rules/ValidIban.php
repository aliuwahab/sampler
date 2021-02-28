<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class ValidIban implements Rule
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
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return  true;
//        return $this->IbanValidation($value);
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


    private function IbanValidation(string $isbn)
    {
//        see more here: https://www.instructables.com/How-to-verify-a-ISBN/
        if (Str::length($isbn) !== 10) {

            return false;
        }

        return true;
    }
}
