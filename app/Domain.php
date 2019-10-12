<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

class Domain extends Model
{
    protected $fillable=['name','status','user_id','hash_key'];
    const DOMAIN_VERIFY_PREFIX= 'domain-owner-ship';

//    const
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
