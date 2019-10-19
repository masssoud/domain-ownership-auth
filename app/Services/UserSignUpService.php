<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/11/2019
 * Time: 10:09 PM
 */

namespace App\Services;


use App\Domain;
use App\Http\Requests\UserStoreRequest;
use App\Interfaces\DomainRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use http\Client\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserSignUpService
{
    private $userRepository;

    /**
     * DomainAuthService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    /**
     * @param UserStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function execute(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($request);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),Response::HTTP_CREATED);
    }
}