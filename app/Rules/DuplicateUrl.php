<?php

namespace App\Rules;

use App\Domain;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

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
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!starts_with($value, ['http://'])) {
            return false;
        } else {
            if (starts_with($value, 'http://www.')) {
                $domain = substr($value, 11);
                $published_domain = Domain::where('url', $domain)->where('status', 1)->first();
                $duplicate_domain = Domain::where('url', $domain)->where('user_id', 1)->first();
            } else {
                $domain = substr($value, 7);
                $published_domain = Domain::where('url', $domain)->where('status', 1)->first();
                $duplicate_domain = Domain::where('url', $domain)->where('user_id', Auth::id())->first();
            }
            return $this->checkDomainAvailability($published_domain,$duplicate_domain);
        }

//        $published_domain = Domain::where('url',$value)->where('status',1)->first();
//        $duplicate_domain = Domain::where('url',$value)->where('user_id',Auth::id())->first();
//        if ((is_null($published_domain)) && (is_null($duplicate_domain))){
//            return true;
//        }
//        else{
//            return false;
//        }
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

    public function checkDomainAvailability($published_domain, $duplicate_domain)
    {
        if ((is_null($published_domain)) && (is_null($duplicate_domain))) {
            return true;
        } else {
            return false;
        }
    }
}
