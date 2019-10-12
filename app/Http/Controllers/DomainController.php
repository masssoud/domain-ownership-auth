<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Http\Requests\DomainStoreRequest;
use App\Interfaces\DomainRepositoryInterface;
use App\Services\DomainAuthService;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    private $domainRepository;

    /**
     * DomainController constructor.
     * @param DomainRepositoryInterface $domainRepository
     */
    public function __construct(DomainRepositoryInterface $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->domainRepository->getAllItems();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DomainStoreRequest $request
     * @return void
     */
    public function store(DomainStoreRequest $request)
    {
        Domain::create([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
            'status'=>0,
            'hash_key'=>str_random(32)
        ]);

    }

    public function domainAuth($domain){
        return $data = (new DomainAuthService())->checkAuth($domain);
    }
}
