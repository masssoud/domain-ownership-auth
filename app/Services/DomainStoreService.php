<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 10:09 PM
 */

namespace App\Services;


use App\Domain;
use App\Interfaces\DomainRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DomainStoreService
{
    private $domainRepository;

    /**
     * DomainAuthService constructor.
     * @param DomainRepositoryInterface $domainRepository
     */
    public function __construct(DomainRepositoryInterface $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }


    /**
     * @param $attr
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute($attr)
    {
        $domain = Domain::create([
            'url'=>$this->urlCheck($attr->url),
            'user_id'=>Auth::id(),
            'status'=>0,
            'hash_key'=>Domain::DOMAIN_VERIFY_PREFIX.'='.str_random(32)
        ]);

        return (new Domain())->where('id',$domain->id)->get();
    }

    private function urlCheck($url){
        if (strpos($url,'www.')){
            $domain = str_replace('http://www.', '',$url);
        }
        else{
            $domain = str_replace('http://', '',$url);
        }
        return $domain;
    }
}