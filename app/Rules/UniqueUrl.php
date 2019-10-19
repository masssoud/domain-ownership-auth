<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueUrl implements Rule
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
//        if (!starts_with($value, ['http://']))
//        {
//            return false;
//        }
//        else{
//            if (starts_with($value,'http://www.')){
//                $domain = substr($value,7);
//                dd($domain);
//                dd($value,starts_with($value, 'http://www.'));
//            }
//            else{
//                dd('asd');
//            }
//        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error messagess.';
    }
}
