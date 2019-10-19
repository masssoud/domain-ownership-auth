<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Http\Requests\DomainStoreRequest;
use App\Http\Resources\DomainResource;
use App\Interfaces\DomainRepositoryInterface;
use App\Services\DomainAuthService;
use App\Services\DomainStoreService;
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
     * @return DomainResource
     */
    public function index()
    {
        $user_domains = $this->domainRepository->getAllItems();
        return new DomainResource($user_domains);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DomainStoreRequest $request
     * @return
     */
    public function store(DomainStoreRequest $request)
    {
        $data = (new DomainStoreService($this->domainRepository))->execute($request);
        return new DomainResource($data);

    }

    public function domainAuth($domain){
        return $data = (new DomainAuthService($this->domainRepository))->checkAuth($domain);
    }
}
