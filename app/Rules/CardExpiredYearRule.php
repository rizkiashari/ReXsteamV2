<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardExpiredYearRule implements Rule
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
        return  $value >= date('Y') && $value <= 2050;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Card year must between 2021 and 2050.';
    }
}
