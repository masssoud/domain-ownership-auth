<?php
/**
 * Created by PhpStorm.
 * domain: domain
 * Date: 9/3/2019
 * Time: 3:12 AM
 */

namespace App\Repositories;


use App\Domain;
use App\Interfaces\DomainRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DomainRepository implements DomainRepositoryInterface
{
    /**
     * @var Domain
     */
    private $domain;

    /**
     * domainRepository constructor.
     * @param Domain $domain $domain
     */
    public function __construct(Domain $domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return mixed
     */
    public function getAllItems()
    {
        return $this->domain->where('user_id',Auth::id())->paginate(1);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getItem($id)
    {
        return $this->domain->find($id)->select('hash_key')->first();
    }

    /**
     * @param $domain
     * @param $user
     * @return mixed
     */
    public function getUserItemByDomain($domain, $user)
    {
       return $this->domain->select('hash_key')->where('user_id',$user)->where('url',$domain)->first();
    }
}