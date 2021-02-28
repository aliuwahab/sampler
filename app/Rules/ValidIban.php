<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

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
        return $this->IbanValidation();
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


    private function IbanValidation(int $iban)
    {
        return true;
    }
}
