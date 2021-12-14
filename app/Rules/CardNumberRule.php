<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardNumberRule implements Rule
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
        $isPassed = true;
        $cardNumber = explode(' ', $value);

        foreach ($cardNumber as $number) {
            if (strlen($number) != 4 || !is_numeric($number)) {
                $isPassed = false;
            }
        }

        return $isPassed;
    }


    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Card number must be in "0000 0000 0000 0000" format.';
    }
}
