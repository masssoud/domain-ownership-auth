<?php

namespace App\Http\Middleware;

use App\Interfaces\DomainRepositoryInterface;
use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DomainMiddleware
{
    private $domainRepository;

    /**
     * DomainMiddleware constructor.
     * @param DomainRepositoryInterface $domainRepository
     */
    public function __construct(DomainRepositoryInterface $domainRepository)
    {
        $this->domainRepository = $domainRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domain = $this->domainRepository->getUserItemByDomain(request()->route('url'),Auth::id());
        if (is_null($domain)){
            return response()->json(['message' => 'Domain access is forbidden.'],Response::HTTP_FORBIDDEN);
        }
        return $next($request);
    }
}
