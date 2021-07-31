<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AreaCode implements Rule
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
        if (! is_numeric($value)) {
            return false;
        }
        if (strlen($value) > 4 or strlen($value) < 2) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'La característica tiene que tener entre 2 y 4 dígitos.';
    }
}
