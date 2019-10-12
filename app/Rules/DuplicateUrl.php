<?php

namespace App\Rules;

use App\Domain;
use Illuminate\Contracts\Validation\Rule;

class DuplicateUrl implements Rule
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
        $published_domain = Domain::where('name',$value)->where('status',1)->first();
        $duplicate_domain = Domain::where('name',$value)->where('user_id',request()->user_id)->first();
        if (is_null($published_domain) && is_null($duplicate_domain)){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Domain is registered before.';
    }
}
