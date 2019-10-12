<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Http\Requests\DomainStoreRequest;
use App\Interfaces\DomainRepositoryInterface;
use App\Services\DomainAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return
     */
    public function store(DomainStoreRequest $request)
    {
        $data = $this->domainRepository->save($request);
        return response()->json([
            'status'=>'Successfully stored.'
        ],200);
    }

    public function domainAuth($domain){
        return $data = (new DomainAuthService($this->domainRepository))->checkAuth($domain);
    }
}
